<?php

namespace App\Http\Controllers;

use App\Support\LamaranHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
                'select' => 'lamaran_id,status_terakhir,hasil_interview,created_at,pelamar:pelamar_id(pelamar_id,nama_lengkap,email,foto_profil,nim,bidang),lowongan:lowongan_id(lowongan_id,judul,perusahaan_id),berkas:berkas_lamaran_id(cv,portofolio,surat_lamaran,transkip_nilai,pas_foto)',
                'order'  => 'created_at.desc',
            ]);

        $lamaran = $response->json();

        // Safeguard: if Supabase returns an error object instead of an array of rows
        if (!is_array($lamaran) || (isset($lamaran['message']) || isset($lamaran['code']))) {
            Log::error('Supabase lamaran query failed', ['response' => $lamaran]);
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
                'select'     => 'lamaran_id,status_terakhir,hasil_interview,created_at,updated_at,pelamar:pelamar_id(pelamar_id,nama_lengkap,email,foto_profil,nim,bidang),lowongan:lowongan_id(lowongan_id,judul,perusahaan_id,jumlah_person),berkas:berkas_lamaran_id(cv,portofolio,surat_lamaran,transkip_nilai,pas_foto)',
            ])->json();

        if (empty($response) || !is_array($response)) {
            abort(404, 'Lamaran tidak ditemukan.');
        }

        $lamaran = $response[0];

        // Verifikasi kepemilikan
        if (($lamaran['lowongan']['perusahaan_id'] ?? null) !== $perusahaanId) {
            abort(403, 'Akses ditolak.');
        }

        $interviewDetail = [
            'interview_time' => '',
            'link_meet' => '',
            'pesan_tambahan' => '',
        ];
        $interviewResultEmail = [
            'sent' => false,
            'result' => null,
        ];

        if (($lamaran['status_terakhir'] ?? '') === 'interview') {
            $notification = Http::withHeaders($this->headers())
                ->get($this->baseUrl . '/rest/v1/notifikasi', [
                    'lamaran_id' => 'eq.' . $lamaranId,
                    'tipe'       => 'eq.interview',
                    'select'     => 'pesan,link_zoom',
                    'order'      => 'created_at.desc',
                    'limit'      => 1,
                ])->json();

            if (!empty($notification[0])) {
                $pesan = $notification[0]['pesan'] ?? '';
                $interviewDetail['link_meet'] = $notification[0]['link_zoom'] ?? '';

                if (preg_match('/Jadwal:\s*(.*?)(?:\r?\n|$)/u', $pesan, $scheduleMatches)) {
                    $scheduleText = trim($scheduleMatches[1]);
                    $monthMap = [
                        'Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr', 'Mei' => 'May', 'Jun' => 'Jun',
                        'Jul' => 'Jul', 'Agu' => 'Aug', 'Sep' => 'Sep', 'Okt' => 'Oct', 'Nov' => 'Nov', 'Des' => 'Dec',
                        'Januari' => 'January', 'Februari' => 'February', 'Maret' => 'March', 'April' => 'April',
                        'Mei' => 'May', 'Juni' => 'June', 'Juli' => 'July', 'Agustus' => 'August',
                        'September' => 'September', 'Oktober' => 'October', 'November' => 'November', 'Desember' => 'December',
                    ];

                    if (preg_match('/(\d{1,2})\s+([a-zA-Z]+)\s+(\d{4})\s+pukul\s+(\d{2}:\d{2})/u', $scheduleText, $dateMatches)) {
                        $month = $monthMap[$dateMatches[2]] ?? $dateMatches[2];

                        try {
                            $interviewDetail['interview_time'] = \Carbon\Carbon::parse("{$dateMatches[1]} {$month} {$dateMatches[3]} {$dateMatches[4]}")->format('Y-m-d\TH:i');
                        } catch (\Throwable $e) {
                            Log::warning('Gagal parse jadwal interview', [
                                'lamaran_id' => $lamaranId,
                                'jadwal' => $scheduleText,
                            ]);
                        }
                    }
                }

                if (preg_match('/💬\s*(.*)$/us', $pesan, $messageMatches)) {
                    $interviewDetail['pesan_tambahan'] = trim($messageMatches[1]);
                }
            }

            $resultNotification = Http::withHeaders($this->headers())
                ->get($this->baseUrl . '/rest/v1/notifikasi', [
                    'lamaran_id' => 'eq.' . $lamaranId,
                    'tipe'       => 'eq.interview_result',
                    'select'     => 'pesan',
                    'order'      => 'created_at.desc',
                    'limit'      => 1,
                ])->json();

            if (!empty($resultNotification[0])) {
                $interviewResultEmail['sent'] = true;
                $interviewResultEmail['result'] = LamaranHelper::parseInterviewResultFromPesan($resultNotification[0]['pesan'] ?? '')
                    ?? (str_contains(strtolower($resultNotification[0]['pesan'] ?? ''), 'diterima') ? 'accepted' : 'rejected');
            }
        }

        $hasilInterview = $lamaran['hasil_interview'] ?? null;
        if (!$hasilInterview && ($lamaran['status_terakhir'] ?? '') === 'completed') {
            $resultNotif = Http::withHeaders($this->headers())
                ->get($this->baseUrl . '/rest/v1/notifikasi', [
                    'lamaran_id' => 'eq.' . $lamaranId,
                    'tipe'       => 'eq.interview_result',
                    'select'     => 'pesan',
                    'order'      => 'created_at.desc',
                    'limit'      => 1,
                ])->json();
            $hasilInterview = LamaranHelper::parseInterviewResultFromPesan($resultNotif[0]['pesan'] ?? null);
        }

        $lowonganId = $lamaran['lowongan']['lowongan_id'] ?? null;
        $jumlahPerson = (int) ($lamaran['lowongan']['jumlah_person'] ?? 0);
        $acceptedCount = $lowonganId
            ? LamaranHelper::countAcceptedForLowongan($this->baseUrl, $this->headers(), (string) $lowonganId)
            : 0;

        return view('company.pages.pelamar.edit', [
            'lamaran' => $lamaran,
            'interviewDetail' => $interviewDetail,
            'interviewResultEmail' => $interviewResultEmail,
            'hasilInterview' => $hasilInterview,
            'quotaInfo' => [
                'acceptedCount' => $acceptedCount,
                'jumlahPerson'  => $jumlahPerson,
                'quotaFull'     => LamaranHelper::isQuotaFull($acceptedCount, $jumlahPerson),
            ],
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
                'select'     => 'lamaran_id,pelamar_id,status_terakhir,lowongan:lowongan_id(perusahaan_id,judul)',
            ])->json();

        if (empty($lamaran) || ($lamaran[0]['lowongan']['perusahaan_id'] ?? null) !== $perusahaanId) {
            return response()->json(['error' => 'Akses ditolak'], 403);
        }

        $statusFlow = ['applied', 'reviewed', 'interview', 'completed'];
        $currentStatus = $lamaran[0]['status_terakhir'] ?? 'applied';
        $currentIndex = array_search($currentStatus, $statusFlow, true);
        $targetIndex = array_search($request->status, $statusFlow, true);

        if ($currentIndex === false || $targetIndex === false || !in_array($targetIndex - $currentIndex, [0, 1], true)) {
            return response()->json([
                'error' => 'Status harus diubah berurutan: Applied → Reviewed → Interview → Completed. Tidak bisa lompat atau kembali ke tahap sebelumnya.',
            ], 422);
        }

        if (
            $request->status === 'completed' &&
            $currentStatus === 'interview' &&
            !session('interview_result_email_sent.' . $lamaranId, false)
        ) {
            $resultNotification = Http::withHeaders($this->headers())
                ->get($this->baseUrl . '/rest/v1/notifikasi', [
                    'lamaran_id' => 'eq.' . $lamaranId,
                    'tipe'       => 'eq.interview_result',
                    'select'     => 'notifikasi_id',
                    'limit'      => 1,
                ])->json();

            if (!empty($resultNotification)) {
                session()->put('interview_result_email_sent.' . $lamaranId, true);
            } else {
                return response()->json([
                    'error' => 'Kirim email diterima atau ditolak ke pelamar terlebih dahulu sebelum menyelesaikan proses.',
                ], 422);
            }
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

    public function sendInterviewResultEmail(Request $request, string $lamaranId)
    {
        $request->validate([
            'result'  => 'required|in:accepted,rejected',
            'message' => 'nullable|string|max:1000',
        ]);

        $perusahaanId = session('user')['id'];

        $response = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'lamaran_id' => 'eq.' . $lamaranId,
                'select'     => 'lamaran_id,status_terakhir,pelamar:pelamar_id(nama_lengkap,email),lowongan:lowongan_id(lowongan_id,judul,perusahaan_id,jumlah_person)',
            ])->json();

        if (empty($response) || !is_array($response)) {
            return response()->json(['error' => 'Lamaran tidak ditemukan.'], 404);
        }

        $lamaran = $response[0];

        if (($lamaran['lowongan']['perusahaan_id'] ?? null) !== $perusahaanId) {
            return response()->json(['error' => 'Akses ditolak.'], 403);
        }

        if (($lamaran['status_terakhir'] ?? '') !== 'interview') {
            return response()->json(['error' => 'Email hasil hanya bisa dikirim saat kandidat berada di tahap interview.'], 422);
        }

        $existingResultEmail = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/notifikasi', [
                'lamaran_id' => 'eq.' . $lamaranId,
                'tipe'       => 'eq.interview_result',
                'select'     => 'notifikasi_id',
                'limit'      => 1,
            ])->json();

        if (!empty($existingResultEmail)) {
            session()->put('interview_result_email_sent.' . $lamaranId, true);

            return response()->json(['error' => 'Email hasil interview sudah pernah dikirim.'], 422);
        }

        $lowonganId = (string) ($lamaran['lowongan']['lowongan_id'] ?? '');
        $jumlahPerson = (int) ($lamaran['lowongan']['jumlah_person'] ?? 0);
        $acceptedCount = $lowonganId !== ''
            ? LamaranHelper::countAcceptedForLowongan($this->baseUrl, $this->headers(), $lowonganId)
            : 0;

        if ($request->result === 'accepted' && LamaranHelper::isQuotaFull($acceptedCount, $jumlahPerson)) {
            return response()->json(['error' => 'Kuota lowongan sudah penuh. Tidak bisa menerima kandidat lagi.'], 422);
        }

        $pelamarEmail = $lamaran['pelamar']['email'] ?? null;
        if (empty($pelamarEmail)) {
            return response()->json(['error' => 'Email pelamar tidak ditemukan.'], 422);
        }

        $perusahaan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/perusahaan', [
                'perusahaan_id' => 'eq.' . $perusahaanId,
                'select'        => 'nama_perusahaan,email_perusahaan',
                'limit'         => 1,
            ])->json();

        $resultLabel = $request->result === 'accepted' ? 'Diterima' : 'Ditolak';
        $companyName = $perusahaan[0]['nama_perusahaan'] ?? session('full_name', 'Perusahaan');
        $companyEmail = $perusahaan[0]['email_perusahaan'] ?? session('email');

        if (empty($companyEmail)) {
            return response()->json(['error' => 'Email perusahaan tidak ditemukan.'], 422);
        }

        $fromAddress = config('mail.from.address');
        $fromName = $companyName . ' via Dinus Career Center';

        try {
            Mail::send('emails.interview-result', [
                'result'       => $request->result,
                'resultLabel'  => $resultLabel,
                'customMessage'=> $request->message,
                'pelamarName'  => $lamaran['pelamar']['nama_lengkap'] ?? 'Kandidat',
                'position'     => $lamaran['lowongan']['judul'] ?? 'posisi yang dilamar',
                'companyName'  => $companyName,
                'companyEmail' => $companyEmail,
            ], function ($message) use ($pelamarEmail, $lamaran, $resultLabel, $fromAddress, $fromName, $companyEmail, $companyName) {
                $message->from($fromAddress, $fromName)
                    ->replyTo($companyEmail, $companyName)
                    ->to($pelamarEmail, $lamaran['pelamar']['nama_lengkap'] ?? null)
                    ->subject('Hasil Interview Lamaran Anda: ' . $resultLabel);
            });
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email hasil interview', [
                'lamaran_id' => $lamaranId,
                'error'      => $e->getMessage(),
            ]);

            return response()->json(['error' => 'Gagal mengirim email. Pastikan konfigurasi SMTP sudah benar.'], 500);
        }

        session()->put('interview_result_email_sent.' . $lamaranId, true);

        $patchResult = Http::withHeaders($this->headers())
            ->patch($this->baseUrl . '/rest/v1/lamaran?lamaran_id=eq.' . $lamaranId, [
                'hasil_interview' => $request->result,
            ]);

        if ($patchResult->failed()) {
            Log::warning('Gagal menyimpan hasil_interview ke lamaran', [
                'lamaran_id' => $lamaranId,
                'response'   => $patchResult->body(),
            ]);
        }

        Http::withHeaders($this->headers())
            ->post($this->baseUrl . '/rest/v1/notifikasi', [
                'pelamar_id' => $lamaran['pelamar_id'] ?? null,
                'lamaran_id' => $lamaranId,
                'judul'      => 'Hasil Interview: ' . $resultLabel,
                'pesan'      => 'hasil:' . $request->result . '|Email hasil interview sudah dikirim dengan hasil: ' . strtolower($resultLabel),
                'tipe'       => 'interview_result',
            ]);

        if ($request->result === 'accepted' && LamaranHelper::isQuotaFull($acceptedCount + 1, $jumlahPerson)) {
            Http::withHeaders($this->headers())
                ->patch($this->baseUrl . '/rest/v1/lowongan?lowongan_id=eq.' . $lowonganId, [
                    'status_loker' => 'tidak',
                ]);
        }

        return response()->json(['success' => true, 'message' => 'Email hasil interview berhasil dikirim.']);
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