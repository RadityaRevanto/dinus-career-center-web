<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LamaranController extends Controller
{
    private $baseUrl;
    private $serviceRole;

    public function __construct()
    {
        $this->baseUrl     = config('services.supabase.url');
        $this->serviceRole = config('services.supabase.service_role');
    }

    private function headers(): array
    {
        return [
            'apikey'        => $this->serviceRole,
            'Authorization' => 'Bearer ' . $this->serviceRole,
            'Content-Type'  => 'application/json',
        ];
    }

    private function getCompanyLamaran(string $perusahaanId): array
    {
        $response = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'select' => 'lamaran_id,status_terakhir,created_at,pelamar:pelamar_id(pelamar_id,nama_lengkap,email,foto_profil,nim,bidang),lowongan:lowongan_id(lowongan_id,judul,perusahaan_id),berkas:berkas_lamaran_id(cv,portofolio,surat_lamaran,transkip_nilai,pas_foto)',
                'order'  => 'created_at.desc',
            ]);

        $lamaran = $response->json();

        // Safeguard: if Supabase returns an error object instead of an array of rows
        if (!is_array($lamaran) || (isset($lamaran['message']) || isset($lamaran['code']))) {
            \Log::error('Supabase lamaran query failed', ['response' => $lamaran]);
            $lamaran = [];
        }

        $lamaran = array_filter($lamaran, function($l) use ($perusahaanId) {
            return ($l['lowongan']['perusahaan_id'] ?? null) === $perusahaanId;
        });

        return array_values($lamaran);
    }

    public function index()
    {
        $perusahaanId = session('user')['id'];
        $lamaran = $this->getCompanyLamaran($perusahaanId);

        $stats = [
            'total'     => count($lamaran),
            'applied'   => count(array_filter($lamaran, fn($l) => $l['status_terakhir'] === 'applied')),
            'reviewed'  => count(array_filter($lamaran, fn($l) => $l['status_terakhir'] === 'reviewed')),
            'interview' => count(array_filter($lamaran, fn($l) => $l['status_terakhir'] === 'interview')),
            'completed' => count(array_filter($lamaran, fn($l) => $l['status_terakhir'] === 'completed')),
        ];

        $lowongan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lowongan', [
                'perusahaan_id' => 'eq.' . $perusahaanId,
                'select'        => 'lowongan_id,judul',
                'order'         => 'created_at.desc',
            ])->json();

        return view('company.pages.pelamar.index', [
            'lamaran' => $lamaran,
            'stats'   => $stats,
            'lowongan' => $lowongan,
        ]);
    }

    public function export()
    {
        $perusahaanId = session('user')['id'];
        $lamaran = $this->getCompanyLamaran($perusahaanId);
        $filename = 'data-pelamar-' . now()->format('Y-m-d-His') . '.xls';

        return response()
            ->view('company.pages.pelamar.export-excel', [
                'lamaran' => $lamaran,
            ])
            ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
    }

    public function edit(string $lamaranId)
    {
        $perusahaanId = session('user')['id'];

        $response = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'lamaran_id' => 'eq.' . $lamaranId,
                'select'     => 'lamaran_id,status_terakhir,created_at,updated_at,pelamar:pelamar_id(pelamar_id,nama_lengkap,email,foto_profil,nim,bidang),lowongan:lowongan_id(lowongan_id,judul,perusahaan_id),berkas:berkas_lamaran_id(cv,portofolio,surat_lamaran,transkip_nilai,pas_foto)',
            ])->json();

        if (empty($response) || !is_array($response)) {
            abort(404, 'Lamaran tidak ditemukan.');
        }

        $lamaran = $response[0];

        // Verifikasi kepemilikan
        if (($lamaran['lowongan']['perusahaan_id'] ?? null) !== $perusahaanId) {
            abort(403, 'Akses ditolak.');
        }

        return view('company.pages.pelamar.edit', [
            'lamaran' => $lamaran,
        ]);
    }

    public function updateStatus(Request $request, string $lamaranId)
    {
        $rules = [
            'status' => 'required|in:applied,reviewed,interview,completed',
        ];

        if ($request->status === 'interview') {
            $rules['interview_time']  = 'required|date';
            $rules['link_meet']       = 'required|url';
            $rules['pesan_tambahan']  = 'nullable|string|max:500';
        }

        $request->validate($rules);

        $perusahaanId = session('user')['id'];

        $lamaran = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'lamaran_id' => 'eq.' . $lamaranId,
                'select'     => 'lamaran_id,pelamar_id,lowongan:lowongan_id(perusahaan_id,judul)',
            ])->json();

        if (empty($lamaran) || ($lamaran[0]['lowongan']['perusahaan_id'] ?? null) !== $perusahaanId) {
            return response()->json(['error' => 'Akses ditolak'], 403);
        }

        $res = Http::withHeaders($this->headers())
            ->patch($this->baseUrl . '/rest/v1/lamaran?lamaran_id=eq.' . $lamaranId, [
                'status_terakhir' => $request->status,
            ]);

        if ($res->failed()) {
            return response()->json(['error' => 'Gagal update status'], 500);
        }

        // Jika status interview, update notifikasi yang dibuat trigger dengan detail jadwal
        if ($request->status === 'interview') {
            $judulLowongan = $lamaran[0]['lowongan']['judul'] ?? 'posisi ini';
            $jamFormatted  = \Carbon\Carbon::parse($request->interview_time)
                                ->translatedFormat('l, d M Y \p\u\k\u\l H:i');

            $pesan  = 'Selamat! Lamaran Anda untuk posisi "' . $judulLowongan . '" telah lolos ke tahap interview.' . "\n\n";
            $pesan .= '📅 Jadwal: ' . $jamFormatted . "\n";
            $pesan .= '🔗 Link Meeting: ' . $request->link_meet;

            if (!empty($request->pesan_tambahan)) {
                $pesan .= "\n\n💬 " . $request->pesan_tambahan;
            }

            // Cari notifikasi interview terbaru yang dibuat trigger, lalu update dengan detail lengkap
            $notif = Http::withHeaders($this->headers())
                ->get($this->baseUrl . '/rest/v1/notifikasi', [
                    'lamaran_id' => 'eq.' . $lamaranId,
                    'tipe'       => 'eq.interview',
                    'order'      => 'created_at.desc',
                    'limit'      => 1,
                ])->json();

            if (!empty($notif) && isset($notif[0]['notifikasi_id'])) {
                Http::withHeaders($this->headers())
                    ->patch($this->baseUrl . '/rest/v1/notifikasi?notifikasi_id=eq.' . $notif[0]['notifikasi_id'], [
                        'pesan'     => $pesan,
                        'link_zoom' => $request->link_meet,
                    ]);
            } else {
                // Fallback: trigger belum sempat insert, insert manual
                Http::withHeaders($this->headers())
                    ->post($this->baseUrl . '/rest/v1/notifikasi', [
                        'pelamar_id' => $lamaran[0]['pelamar_id'],
                        'lamaran_id' => $lamaranId,
                        'judul'      => '🎉 Selamat! Anda Lolos ke Tahap Interview',
                        'pesan'      => $pesan,
                        'tipe'       => 'interview',
                        'link_zoom'  => $request->link_meet,
                    ]);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Proxy download dokumen pelamar supaya URL Supabase tidak terexpose ke browser.
     */
    public function downloadBerkas(string $lamaranId, string $tipe)
    {
        $allowedTypes = ['cv', 'portofolio', 'surat_lamaran', 'transkip_nilai', 'pas_foto'];

        if (!in_array($tipe, $allowedTypes)) {
            abort(404, 'Tipe dokumen tidak valid.');
        }

        $perusahaanId = session('user')['id'];

        // Ambil data lamaran beserta berkas & verifikasi kepemilikan
        $lamaran = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'lamaran_id' => 'eq.' . $lamaranId,
                'select'     => 'lamaran_id,lowongan:lowongan_id(perusahaan_id),berkas:berkas_lamaran_id(cv,portofolio,surat_lamaran,transkip_nilai,pas_foto)',
            ])->json();

        if (empty($lamaran) || ($lamaran[0]['lowongan']['perusahaan_id'] ?? null) !== $perusahaanId) {
            abort(403, 'Akses ditolak.');
        }

        $fileUrl = $lamaran[0]['berkas'][$tipe] ?? null;

        if (empty($fileUrl)) {
            abort(404, 'Dokumen tidak ditemukan.');
        }

        // Fetch file dari Supabase secara server-side
        $fileResponse = Http::withHeaders([
            'apikey'        => $this->serviceRole,
            'Authorization' => 'Bearer ' . $this->serviceRole,
        ])->get($fileUrl);

        if ($fileResponse->failed()) {
            abort(502, 'Gagal mengambil dokumen.');
        }

        $contentType = $fileResponse->header('Content-Type') ?? 'application/octet-stream';

        // Tentukan nama file yang user-friendly
        $extension = match (true) {
            str_contains($contentType, 'pdf')  => 'pdf',
            str_contains($contentType, 'word') => 'docx',
            str_contains($contentType, 'png')  => 'png',
            str_contains($contentType, 'jpeg'), str_contains($contentType, 'jpg') => 'jpg',
            default => 'pdf',
        };

        $filename = $tipe . '_' . $lamaranId . '.' . $extension;

        return response($fileResponse->body(), 200, [
            'Content-Type'        => $contentType,
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
            'Cache-Control'       => 'private, max-age=3600',
        ]);
    }
    
}