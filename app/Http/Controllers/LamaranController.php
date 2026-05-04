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

    public function index()
    {
        $perusahaanId = session('user')['id'];

        $lamaran = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'select' => '
                    lamaran_id,
                    status_terakhir,
                    created_at,
                    pelamar:pelamar_id(pelamar_id, nama_lengkap, email, foto_profil, nim, bidang),
                    lowongan:lowongan_id(lowongan_id, judul, perusahaan_id),
                    berkas:berkas_lamaran_id(cv, portofolio, surat_lamaran)
                ',
                'order' => 'created_at.desc',
            ])->json();

        $lamaran = array_filter($lamaran, function($l) use ($perusahaanId) {
            return ($l['lowongan']['perusahaan_id'] ?? null) === $perusahaanId;
        });

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
            'lamaran' => array_values($lamaran),
            'stats'   => $stats,
            'lowongan' => $lowongan,
        ]);
    }

    public function updateStatus(Request $request, string $lamaranId)
    {
        $request->validate([
            'status' => 'required|in:applied,reviewed,interview,completed',
        ]);

        $perusahaanId = session('user')['id'];

        $lamaran = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'lamaran_id' => 'eq.' . $lamaranId,
                'select'     => 'lamaran_id,lowongan:lowongan_id(perusahaan_id)',
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

        return response()->json(['success' => true]);
    }
}