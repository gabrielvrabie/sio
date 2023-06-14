<?php

declare(strict_types=1);

namespace App\Service;

/**
 * @desc This class is a simple example of a service that can be used to convert time from seconds to hours, minutes and seconds and vice versa.
 */
final class TimeConverter
{
    public function toSeconds(int $hours, int $minutes): int
    {
        return $hours * 3600 + $minutes * 60;
    }

    /**
     * @return array{days: int, hours: int, minutes: int, seconds: int
     */
    public function fromSeconds(int $seconds): array
    {
        $days = (int) ($seconds / 86400);
        $hours = (int) (($seconds - $days * 86400) / 3600);
        $minutes = (int) (($seconds - $days * 86400 - $hours * 3600) / 60);
        $seconds = (int) ($seconds - $days * 86400 - $hours * 3600 - $minutes * 60);

        return [$days, $hours, $minutes, $seconds];
    }
}
