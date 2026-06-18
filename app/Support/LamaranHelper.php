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
     * @param array<int, array{lowongan_id?: string|int, status_terakhir?: string|null}> $rows
     * @return array<int|string, int>
     */
    public static function countAcceptedByLowongan(array $rows): array
    {
        $counts = [];

        foreach ($rows as $row) {
            if (($row['status_terakhir'] ?? null) !== LamaranStatus::ACCEPTED) {
                continue;
            }

            $lowonganId = $row['lowongan_id'] ?? null;
            if ($lowonganId !== null) {
                $counts[$lowonganId] = ($counts[$lowonganId] ?? 0) + 1;
            }
        }

        return $counts;
    }

    public static function parseReviewResultFromPesan(?string $pesan): ?string
    {
        return self::parseInterviewResultFromPesan($pesan);
    }

    public static function hasReviewResultEmailSent(string $baseUrl, array $headers, string $lamaranId): bool
    {
        $response = Http::withHeaders($headers)
            ->get($baseUrl . '/rest/v1/notifikasi', [
                'lamaran_id' => 'eq.' . $lamaranId,
                'tipe'       => 'eq.review_result',
                'select'     => 'notifikasi_id',
                'limit'      => 1,
            ]);

        $rows = $response->json();

        return is_array($rows) && !isset($rows['code']) && !empty($rows);
    }

    public static function getReviewResult(string $baseUrl, array $headers, string $lamaranId): ?string
    {
        $response = Http::withHeaders($headers)
            ->get($baseUrl . '/rest/v1/notifikasi', [
                'lamaran_id' => 'eq.' . $lamaranId,
                'tipe'       => 'eq.review_result',
                'select'     => 'pesan',
                'order'      => 'created_at.desc',
                'limit'      => 1,
            ]);

        $rows = $response->json();
        if (!is_array($rows) || isset($rows['code']) || empty($rows[0])) {
            return null;
        }

        return self::parseReviewResultFromPesan($rows[0]['pesan'] ?? null);
    }

    public static function isQuotaFull(int $acceptedCount, int $jumlahPerson): bool
    {
        return $jumlahPerson > 0 && $acceptedCount >= $jumlahPerson;
    }

    public static function isLowonganExpired(?string $batasAkhir): bool
    {
        if (empty($batasAkhir)) {
            return false;
        }

        return \Carbon\Carbon::parse($batasAkhir)->endOfDay()->isPast();
    }

    /**
     * @return array{is_active: bool, label: string, tone: string}
     */
    public static function resolveLowonganStatus(array $lowongan, int $acceptedCount = 0): array
    {
        $statusLoker = $lowongan['status_loker'] ?? '';
        $expired = self::isLowonganExpired($lowongan['batas_akhir'] ?? null);
        $quotaFull = self::isQuotaFull($acceptedCount, (int) ($lowongan['jumlah_person'] ?? 0));

        if ($statusLoker !== 'aktif') {
            return ['is_active' => false, 'label' => 'Ditutup', 'tone' => 'closed'];
        }

        if ($expired) {
            return ['is_active' => false, 'label' => 'Kedaluwarsa', 'tone' => 'expired'];
        }

        if ($quotaFull) {
            return ['is_active' => false, 'label' => 'Kuota penuh', 'tone' => 'quota'];
        }

        return ['is_active' => true, 'label' => 'Aktif', 'tone' => 'active'];
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
                'lowongan_id'     => $filter,
                'status_terakhir' => 'eq.' . LamaranStatus::ACCEPTED,
                'select'          => 'lowongan_id,status_terakhir',
            ]);

        $rows = $response->json();

        if (is_array($rows) && !isset($rows['code'])) {
            return self::countAcceptedByLowongan($rows);
        }

        return [];
    }

    public static function countAcceptedForLowongan(string $baseUrl, array $headers, string $lowonganId): int
    {
        $counts = self::fetchAcceptedCounts($baseUrl, $headers, [$lowonganId]);

        return $counts[$lowonganId] ?? 0;
    }
}
