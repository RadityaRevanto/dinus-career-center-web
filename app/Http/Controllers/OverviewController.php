<?php

namespace App\Http\Controllers;

use App\Support\LamaranHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OverviewController extends Controller
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

        // 1. Fetch all lowongan for this company
        $lowonganResponse = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lowongan', [
                'perusahaan_id' => 'eq.' . $perusahaanId,
                'select'        => 'lowongan_id,judul,status_loker,batas_akhir,created_at,jumlah_person',
            ]);
        
        $lowongan = $lowonganResponse->json();
        $lowongan = is_array($lowongan) ? $lowongan : [];
        if (isset($lowongan['message']) || isset($lowongan['code'])) {
            Log::error('Supabase lowongan query failed on overview', ['response' => $lowongan]);
            $lowongan = [];
        }

        // 2. Fetch all lamaran for this company (via lowongan relation)
        $lamaranResponse = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'select' => 'lamaran_id,status_terakhir,hasil_interview,created_at,lowongan_id,pelamar:pelamar_id(pelamar_id,nama_lengkap,email,foto_profil,nim,bidang),lowongan:lowongan_id(lowongan_id,judul,perusahaan_id)',
                'order'  => 'created_at.desc',
            ]);

        $allLamaran = $lamaranResponse->json();
        $allLamaran = is_array($allLamaran) ? $allLamaran : [];
        if (isset($allLamaran['message']) || isset($allLamaran['code'])) {
            Log::error('Supabase lamaran query failed on overview', ['response' => $allLamaran]);
            $allLamaran = [];
        }

        $lamaran = array_filter($allLamaran, function($l) use ($perusahaanId) {
            return ($l['lowongan']['perusahaan_id'] ?? null) === $perusahaanId;
        });
        $lamaran = array_values($lamaran);

        // --- Calculate Stats ---
        $isLowonganExpired = fn($job) => !empty($job['batas_akhir']) && Carbon::parse($job['batas_akhir'])->endOfDay()->isPast();
        $lowonganIds = array_column($lowongan, 'lowongan_id');
        $acceptedCounts = LamaranHelper::fetchAcceptedCounts($this->baseUrl, $this->headers(), $lowonganIds);
        $isQuotaFull = fn($job) => LamaranHelper::isQuotaFull(
            $acceptedCounts[$job['lowongan_id']] ?? 0,
            (int) ($job['jumlah_person'] ?? 0)
        );
        $lowonganAktif = array_filter($lowongan, fn($j) => ($j['status_loker'] ?? '') === 'aktif' && !$isLowonganExpired($j) && !$isQuotaFull($j));
        $countLowonganAktif = count($lowonganAktif);
        $countTotalPelamar = count($lamaran);
        $countDiproses = count(array_filter($lamaran, fn($l) => in_array($l['status_terakhir'], ['reviewed', 'interview'])));
        $countDiterima = count(array_filter($lamaran, fn($l) => ($l['hasil_interview'] ?? null) === 'accepted'));

        // --- Status Chart Data ---
        $chartStatusData = [
            'review' => count(array_filter($lamaran, fn($l) => in_array($l['status_terakhir'], ['applied', 'reviewed']))),
            'interview' => count(array_filter($lamaran, fn($l) => $l['status_terakhir'] === 'interview')),
            'diterima' => count(array_filter($lamaran, fn($l) => ($l['hasil_interview'] ?? null) === 'accepted')),
            'ditolak' => count(array_filter($lamaran, fn($l) => ($l['hasil_interview'] ?? null) === 'rejected')),
        ];

        // --- Trend Chart Data (Last 6 Months) ---
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i);
        }

        $chartLabels = [];
        $chartDataPelamar = [];
        $chartDataDiterima = [];

        $monthlyCounts = [];
        foreach ($months as $m) {
            $key = $m->format('Y-m');
            $chartLabels[] = $m->translatedFormat('M');
            $monthlyCounts[$key] = [
                'pelamar' => 0,
                'diterima' => 0
            ];
        }

        foreach ($lamaran as $l) {
            if (empty($l['created_at'])) continue;
            $date = Carbon::parse($l['created_at']);
            $key = $date->format('Y-m');
            if (isset($monthlyCounts[$key])) {
                $monthlyCounts[$key]['pelamar']++;
                if (($l['hasil_interview'] ?? null) === 'accepted') {
                    $monthlyCounts[$key]['diterima']++;
                }
            }
        }

        foreach ($months as $m) {
            $key = $m->format('Y-m');
            $chartDataPelamar[] = $monthlyCounts[$key]['pelamar'];
            $chartDataDiterima[] = $monthlyCounts[$key]['diterima'];
        }

        // --- Lamaran Terbaru (Limit 5) ---
        $lamaranTerbaru = array_slice($lamaran, 0, 5);

        // --- Schedule / Jadwal Interview (Khusus Hari Ini) ---
        $notifikasiResponse = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/notifikasi', [
                'tipe'   => 'eq.interview',
                'select' => 'notifikasi_id,pesan,link_zoom,created_at,pelamar:pelamar_id(nama_lengkap),lamaran:lamaran_id(lamaran_id,lowongan:lowongan_id(judul,perusahaan_id))',
                'order'  => 'created_at.desc',
            ]);
        $allNotif = $notifikasiResponse->json();
        $allNotif = is_array($allNotif) ? $allNotif : [];

        $interviews = [];
        $todayString = \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d M Y');
        $todayStringAlt = \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('d M Y');

        foreach ($allNotif as $n) {
            if (($n['lamaran']['lowongan']['perusahaan_id'] ?? null) === $perusahaanId) {
                $pesan = $n['pesan'] ?? '';
                $timePart = '09:00';
                $datePart = 'Hari Ini';
                $jadwal = '';
                
                if (preg_match('/📅 Jadwal:\s*(.*?)(?:\r?\n|$)/u', $pesan, $matches)) {
                    $jadwal = trim($matches[1]);
                    if (preg_match('/pukul\s*([0-9]{2}:[0-9]{2})/i', $jadwal, $timeMatches)) {
                        $timePart = $timeMatches[1];
                        $datePart = trim(explode('pukul', $jadwal)[0]);
                    } else {
                        $datePart = $jadwal;
                    }
                }
                
                if (str_contains($datePart, $todayString) || str_contains($datePart, $todayStringAlt) || $datePart === 'Hari Ini') {
                    $interviews[] = [
                        'nama_pelamar' => $n['pelamar']['nama_lengkap'] ?? 'Kandidat',
                        'posisi'       => $n['lamaran']['lowongan']['judul'] ?? 'Pekerjaan',
                        'jam'          => $timePart,
                        'tanggal'      => $datePart,
                        'link_zoom'    => $n['link_zoom'] ?? '#',
                    ];
                }
            }
        }
        // $interviews = array_slice($interviews, 0, 3); // Dihapus agar menampilkan semua jadwal hari ini

        // --- Lowongan Aktif Sidebar ---
        $lamaranPerLowongan = [];
        foreach ($lamaran as $l) {
            $lid = $l['lowongan_id'] ?? null;
            if ($lid) {
                $lamaranPerLowongan[$lid] = ($lamaranPerLowongan[$lid] ?? 0) + 1;
            }
        }

        $activeJobs = [];
        $jobColors = [
            ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>'],
            ['bg' => 'bg-purple-100', 'text' => 'text-purple-600', 'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>'],
            ['bg' => 'bg-amber-100', 'text' => 'text-amber-600', 'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>'],
            ['bg' => 'bg-cyan-100', 'text' => 'text-cyan-600', 'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/></svg>'],
        ];

        $idxJob = 0;
        foreach ($lowonganAktif as $job) {
            $jobId = $job['lowongan_id'];
            $applicantCount = $lamaranPerLowongan[$jobId] ?? 0;
            $deadline = isset($job['batas_akhir']) ? Carbon::parse($job['batas_akhir'])->translatedFormat('d M') : 'N/A';
            
            $color = $jobColors[$idxJob % count($jobColors)];
            $idxJob++;
            
            $activeJobs[] = [
                'lowongan_id'   => $jobId,
                'judul'         => $job['judul'],
                'pelamar_count' => $applicantCount,
                'deadline'      => $deadline,
                'bg'            => $color['bg'],
                'text'          => $color['text'],
                'icon'          => $color['icon'],
            ];
        }

        return view('company.pages.overview', compact(
            'countLowonganAktif',
            'countTotalPelamar',
            'countDiproses',
            'countDiterima',
            'chartStatusData',
            'chartLabels',
            'chartDataPelamar',
            'chartDataDiterima',
            'lamaranTerbaru',
            'interviews',
            'activeJobs'
        ));
    }
}
