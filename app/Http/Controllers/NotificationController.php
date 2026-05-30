<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class NotificationController extends Controller
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

    /**
     * API: Fetch latest notifications for the company (used by header dropdown).
     * Prioritizes new applicants (status: applied) so the company gets alerted.
     */
    public function latest()
    {
        $perusahaanId = session('user')['id'];

        // Fetch lamaran for this company to detect new applications
        $lamaranResponse = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'select' => 'lamaran_id,status_terakhir,created_at,lowongan_id,pelamar:pelamar_id(nama_lengkap,foto_profil),lowongan:lowongan_id(lowongan_id,judul,perusahaan_id)',
                'order'  => 'created_at.desc',
                'limit'  => 30,
            ]);

        $allLamaran = $lamaranResponse->json();
        $allLamaran = is_array($allLamaran) ? $allLamaran : [];

        // Also fetch interview notifications from notifikasi table
        $notifResponse = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/notifikasi', [
                'tipe'   => 'eq.interview',
                'select' => 'notifikasi_id,judul,pesan,created_at,pelamar:pelamar_id(nama_lengkap,foto_profil),lamaran:lamaran_id(lamaran_id,lowongan:lowongan_id(judul,perusahaan_id))',
                'order'  => 'created_at.desc',
                'limit'  => 10,
            ]);
        $allNotif = $notifResponse->json();
        $allNotif = is_array($allNotif) ? $allNotif : [];

        $notifications = [];
        $unreadCount = 0;
        $seenIds = []; // Prevent duplicates

        // --- 1. New applicants (applied) — highest priority ---
        foreach ($allLamaran as $l) {
            if (($l['lowongan']['perusahaan_id'] ?? null) !== $perusahaanId) {
                continue;
            }

            $lamaranId = $l['lamaran_id'];
            if (in_array($lamaranId, $seenIds)) continue;
            $seenIds[] = $lamaranId;

            $status = $l['status_terakhir'] ?? 'applied';
            $nama = $l['pelamar']['nama_lengkap'] ?? 'Kandidat';
            $posisi = $l['lowongan']['judul'] ?? 'Pekerjaan';
            $foto = $l['pelamar']['foto_profil'] ?? null;
            $createdAt = $l['created_at'] ?? now();
            $carbonDate = Carbon::parse($createdAt)->timezone('Asia/Jakarta');

            // Build notification message based on status
            switch ($status) {
                case 'applied':
                    $judul = 'Pelamar Baru Mendaftar';
                    $pesan = "{$nama} baru saja melamar posisi \"{$posisi}\"";
                    $icon = 'applied';
                    break;
                case 'reviewed':
                    $judul = 'Lamaran Direview';
                    $pesan = "Lamaran {$nama} untuk \"{$posisi}\" sudah direview";
                    $icon = 'reviewed';
                    break;
                case 'interview':
                    $judul = 'Jadwal Interview';
                    $pesan = "Interview dijadwalkan untuk {$nama} — {$posisi}";
                    $icon = 'interview';
                    break;
                case 'completed':
                    $judul = 'Proses Selesai';
                    $pesan = "Proses rekrutmen {$nama} untuk \"{$posisi}\" selesai";
                    $icon = 'completed';
                    break;
                default:
                    $judul = 'Update Lamaran';
                    $pesan = "Ada update untuk lamaran {$nama}";
                    $icon = 'applied';
            }

            // Count as unread if applied within the last 7 days
            $isRecent = $carbonDate->isAfter(Carbon::now('Asia/Jakarta')->subDays(7));
            if ($status === 'applied' && $isRecent) {
                $unreadCount++;
            }

            $notifications[] = [
                'id'         => $lamaranId,
                'judul'      => $judul,
                'pesan'      => $pesan,
                'icon'       => $icon,
                'status'     => $status,
                'foto'       => $foto ?? 'https://ui-avatars.com/api/?name=' . urlencode($nama) . '&background=e0e7ff&color=4f46e5&bold=true&size=128',
                'waktu'      => $carbonDate->diffForHumans(),
                'created_at' => $carbonDate->toIso8601String(),
                'is_new'     => $status === 'applied' && $isRecent,
            ];
        }

        // Sort: new applicants (applied) first, then by date
        usort($notifications, function ($a, $b) {
            // applied + recent first
            if ($a['is_new'] && !$b['is_new']) return -1;
            if (!$a['is_new'] && $b['is_new']) return 1;
            // then by date descending
            return strcmp($b['created_at'], $a['created_at']);
        });

        // Limit to 15 latest
        $notifications = array_slice($notifications, 0, 15);

        return response()->json([
            'notifications' => $notifications,
            'unread_count'  => $unreadCount,
        ]);
    }
}
