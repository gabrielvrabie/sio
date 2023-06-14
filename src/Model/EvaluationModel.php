<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @desc This class is a simple example of a model that can be used to represent the logged time.
 */
final class EvaluationModel
{
    public function __construct(
        public int $hours,
        public int $minutes,
        public int $seconds,
    )
    {
    }

    // this stupid thing here can be easily moved into a twig function who gets as argument this object
    public function __toString(): string
    {
        return sprintf('%02d Hours:%02d Minutes:%02d Seconds', $this->hours, $this->minutes, $this->seconds);
    }
}
