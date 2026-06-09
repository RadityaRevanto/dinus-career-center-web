<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class InterviewController extends Controller
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

    public function calendar()
    {
        $perusahaanId = session('user')['id'];

        // Fetch notifications of type interview
        $notifikasiResponse = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/notifikasi', [
                'tipe'   => 'eq.interview',
                'select' => 'notifikasi_id,pesan,link_zoom,created_at,pelamar:pelamar_id(nama_lengkap,email,foto_profil),lamaran:lamaran_id(lamaran_id,lowongan:lowongan_id(judul,perusahaan_id))',
                'order'  => 'created_at.desc',
            ]);
        
        $allNotif = $notifikasiResponse->json();
        $allNotif = is_array($allNotif) ? $allNotif : [];

        $indonesianMonths = [
            'Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr', 'Mei' => 'May', 'Jun' => 'Jun',
            'Jul' => 'Jul', 'Agu' => 'Aug', 'Sep' => 'Sep', 'Okt' => 'Oct', 'Nov' => 'Nov', 'Des' => 'Dec',
            'Januari' => 'January', 'Februari' => 'February', 'Maret' => 'March', 'April' => 'April',
            'Mei' => 'May', 'Juni' => 'June', 'Juli' => 'July', 'Agustus' => 'August',
            'September' => 'September', 'Oktober' => 'October', 'November' => 'November', 'Desember' => 'December'
        ];

        $events = [];
        foreach ($allNotif as $n) {
            if (($n['lamaran']['lowongan']['perusahaan_id'] ?? null) === $perusahaanId) {
                $pesan = $n['pesan'] ?? '';
                $timePart = '09:00';
                $datePart = 'Hari Ini';
                $jadwal = '';
                $parsedIsoDate = null;
                
                if (preg_match('/📅 Jadwal:\s*(.*?)(?:\r?\n|$)/u', $pesan, $matches)) {
                    $jadwal = trim($matches[1]);
                    if (preg_match('/pukul\s*([0-9]{2}:[0-9]{2})/i', $jadwal, $timeMatches)) {
                        $timePart = $timeMatches[1];
                        $datePart = trim(explode('pukul', $jadwal)[0]);
                    } else {
                        $datePart = $jadwal;
                    }
                    
                    // Match day, month name, year
                    if (preg_match('/([0-9]{1,2})\s+([a-zA-Z]+)\s+([0-9]{4})/u', $datePart, $dateMatches)) {
                        $day = $dateMatches[1];
                        $monthIndo = $dateMatches[2];
                        $year = $dateMatches[3];
                        
                        $monthEng = $indonesianMonths[$monthIndo] ?? $monthIndo;
                        try {
                            $parsedIsoDate = Carbon::parse("{$day} {$monthEng} {$year} {$timePart}")->format('Y-m-d H:i:s');
                        } catch (\Exception $e) {
                            $parsedIsoDate = null;
                        }
                    }
                }
                
                $eventDate = $parsedIsoDate ? Carbon::parse($parsedIsoDate) : Carbon::parse($n['created_at']);

                $events[] = [
                    'notifikasi_id' => $n['notifikasi_id'],
                    'lamaran_id'    => $n['lamaran']['lamaran_id'] ?? null,
                    'nama_pelamar'  => $n['pelamar']['nama_lengkap'] ?? 'Kandidat',
                    'email'         => $n['pelamar']['email'] ?? '',
                    'foto_profil'   => $n['pelamar']['foto_profil'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($n['pelamar']['nama_lengkap'] ?? 'Kandidat') . '&background=e0e7ff&color=4f46e5&bold=true&size=128',
                    'posisi'        => $n['lamaran']['lowongan']['judul'] ?? 'Pekerjaan',
                    'jam'           => $timePart,
                    'tanggal_text'  => trim($datePart),
                    'tanggal_iso'   => $eventDate->format('Y-m-d'),
                    'datetime_iso'  => $eventDate->format('Y-m-d\TH:i:s'),
                    'link_zoom'     => $n['link_zoom'] ?? '#',
                ];
            }
        }

        return view('company.pages.interviews.calendar', compact('events'));
    }
}
