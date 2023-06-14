<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Entity\WorkTime;
use App\Model\LogTimeModel;
use App\Service\TimeConverter;

/**
 * @desc This class is a simple example of a transformer that can be used to transform a LogTimeModel into a WorkTime entity and vice versa.
 */
final class WorkTimeTransformer
{
    public function __construct(public readonly TimeConverter $timeConverter)
    {
    }

    public function transformToEntity(LogTimeModel $logTimeModel, WorkTime $workTime): WorkTime
    {
        $workTime->setTime($this->timeConverter->toSeconds($logTimeModel->hours, $logTimeModel->minutes));

        return $workTime;
    }

    public function transformToModel(WorkTime $workTime): LogTimeModel
    {
        [$hours, $minutes, $seconds] = $this->timeConverter->fromSeconds($workTime->getTime());

        return new LogTimeModel(
            hours: $hours,
            minutes: $minutes
        );
    }
}
