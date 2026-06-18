<?php

namespace App\Support;

class LamaranStatus
{
    public const APPLIED   = 'applied';
    public const REVIEWED  = 'reviewed';
    public const INTERVIEW = 'interview';
    public const ACCEPTED  = 'accepted';
    public const REJECTED  = 'rejected';

    /** @var list<string> */
    public const FLOW = [
        self::APPLIED,
        self::REVIEWED,
        self::INTERVIEW,
    ];

    /** @var list<string> */
    public const TERMINAL = [
        self::ACCEPTED,
        self::REJECTED,
    ];

    /** @var list<string> */
    public const ALL = [
        self::APPLIED,
        self::REVIEWED,
        self::INTERVIEW,
        self::ACCEPTED,
        self::REJECTED,
    ];

    public static function isTerminal(?string $status): bool
    {
        return in_array($status, self::TERMINAL, true);
    }

    public static function isAccepted(?string $status): bool
    {
        return $status === self::ACCEPTED;
    }

    public static function isRejected(?string $status): bool
    {
        return $status === self::REJECTED;
    }

    public static function label(?string $status): string
    {
        return match ($status) {
            self::APPLIED   => 'Applied',
            self::REVIEWED  => 'Reviewed',
            self::INTERVIEW => 'Interview',
            self::ACCEPTED  => 'Diterima',
            self::REJECTED  => 'Ditolak',
            default         => ucfirst((string) $status),
        };
    }

    /**
     * Index langkah pada timeline UI (0–3).
     */
    public static function timelineIndex(?string $status): int
    {
        if ($status === self::ACCEPTED || $status === self::REJECTED) {
            return 3;
        }

        $index = array_search($status, self::FLOW, true);

        return $index === false ? 0 : (int) $index;
    }

    public static function canTransition(?string $from, ?string $to): bool
    {
        if ($from === $to) {
            return true;
        }

        if (self::isTerminal($from)) {
            return false;
        }

        $fromIndex = array_search($from, self::FLOW, true);
        $toIndex   = array_search($to, self::FLOW, true);

        if ($fromIndex === false || $toIndex === false) {
            return false;
        }

        return $toIndex - $fromIndex === 1;
    }
}
