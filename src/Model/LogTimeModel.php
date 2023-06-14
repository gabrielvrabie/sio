<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @desc This class is a simple example of a model that can be used to represent the logged time.
 */
final class LogTimeModel
{
    public function __construct(
        public int $hours,
        public int $minutes,
    )
    {
    }
}
