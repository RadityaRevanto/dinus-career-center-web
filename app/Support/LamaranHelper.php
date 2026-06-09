<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;

class LamaranHelper
{
    public static function parseInterviewResultFromPesan(?string $pesan): ?string
    {
        if (empty($pesan)) {
            return null;
        }

        if (preg_match('/hasil:(accepted|rejected)/', $pesan, $matches)) {
            return $matches[1];
        }

        $lower = strtolower($pesan);

        if (str_contains($lower, 'diterima')) {
            return 'accepted';
        }

        if (str_contains($lower, 'ditolak')) {
            return 'rejected';
        }

        return null;
    }

    /**
     * @param array<int, array{lowongan_id?: string|int, hasil_interview?: string|null}> $rows
     * @return array<int|string, int>
     */
    public static function countAcceptedByLowongan(array $rows): array
    {
        $counts = [];

        foreach ($rows as $row) {
            if (($row['hasil_interview'] ?? null) !== 'accepted') {
                continue;
            }

            $lowonganId = $row['lowongan_id'] ?? null;
            if ($lowonganId !== null) {
                $counts[$lowonganId] = ($counts[$lowonganId] ?? 0) + 1;
            }
        }

        return $counts;
    }

    public static function isQuotaFull(int $acceptedCount, int $jumlahPerson): bool
    {
        return $jumlahPerson > 0 && $acceptedCount >= $jumlahPerson;
    }

    /**
     * @param array<int|string> $lowonganIds
     * @return array<int|string, int>
     */
    public static function fetchAcceptedCounts(string $baseUrl, array $headers, array $lowonganIds): array
    {
        $lowonganIds = array_values(array_filter($lowonganIds));
        if (empty($lowonganIds)) {
            return [];
        }

        $filter = 'in.(' . implode(',', $lowonganIds) . ')';

        $response = Http::withHeaders($headers)
            ->get($baseUrl . '/rest/v1/lamaran', [
                'lowongan_id'       => $filter,
                'hasil_interview'   => 'eq.accepted',
                'select'            => 'lowongan_id',
            ]);

        $rows = $response->json();

        if (is_array($rows) && !isset($rows['code'])) {
            return self::countAcceptedByLowongan($rows);
        }

        return self::fetchAcceptedCountsFromNotifikasi($baseUrl, $headers, $lowonganIds);
    }

    /**
     * @param array<int|string> $lowonganIds
     * @return array<int|string, int>
     */
    private static function fetchAcceptedCountsFromNotifikasi(string $baseUrl, array $headers, array $lowonganIds): array
    {
        $filter = 'in.(' . implode(',', $lowonganIds) . ')';

        $lamaranRows = Http::withHeaders($headers)
            ->get($baseUrl . '/rest/v1/lamaran', [
                'lowongan_id' => $filter,
                'select'      => 'lamaran_id,lowongan_id',
            ])->json();

        if (!is_array($lamaranRows) || isset($lamaranRows['code']) || empty($lamaranRows)) {
            return [];
        }

        $lamaranToLowongan = [];
        foreach ($lamaranRows as $row) {
            $lamaranToLowongan[$row['lamaran_id']] = $row['lowongan_id'];
        }

        $lamaranFilter = 'in.(' . implode(',', array_keys($lamaranToLowongan)) . ')';

        $notifikasi = Http::withHeaders($headers)
            ->get($baseUrl . '/rest/v1/notifikasi', [
                'lamaran_id' => $lamaranFilter,
                'tipe'       => 'eq.interview_result',
                'select'     => 'lamaran_id,pesan',
            ])->json();

        if (!is_array($notifikasi) || isset($notifikasi['code'])) {
            return [];
        }

        $counts = [];
        foreach ($notifikasi as $notif) {
            if (self::parseInterviewResultFromPesan($notif['pesan'] ?? '') !== 'accepted') {
                continue;
            }

            $lowonganId = $lamaranToLowongan[$notif['lamaran_id']] ?? null;
            if ($lowonganId !== null) {
                $counts[$lowonganId] = ($counts[$lowonganId] ?? 0) + 1;
            }
        }

        return $counts;
    }

    public static function countAcceptedForLowongan(string $baseUrl, array $headers, string $lowonganId): int
    {
        $counts = self::fetchAcceptedCounts($baseUrl, $headers, [$lowonganId]);

        return $counts[$lowonganId] ?? 0;
    }
}
