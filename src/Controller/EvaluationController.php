<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\EvaluationModel;
use App\Repository\WorkTimeRepository;
use App\Service\TimeConverter;
use App\Transformer\WorkTimeTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class EvaluationController extends AbstractController
{
    public function __construct(
        public readonly WorkTimeRepository $workTimeRepository,
        public readonly WorkTimeTransformer $workTimeTransformer,
        public readonly TimeConverter $timeConverter,
    ) {
    }

    #[Route('/evaluation', name: 'evaluation', methods: ['GET'])]
    public function evaluation(): Response
    {
        // Get working time grouped by day
        $workDays = $this->workTimeRepository->getWorkingTimeGroupedByDay();
        $formattedWorkDays = [];

        foreach ($workDays as $workDay) {
            [$days, $hours, $minutes, $seconds] = $this->timeConverter->fromSeconds((int) $workDay['workingTime']);
            $formattedWorkDays[$workDay['day']] = (string) new EvaluationModel(
                hours: $hours,
                minutes: $minutes,
                seconds: $seconds,
            );
        }

        // Ger working time grouped by month
        $workMonths = $this->workTimeRepository->getWorkingTimeGroupByMonth();
        $formattedWorkMonths = [];
        foreach ($workMonths as $workMonth) {
            [$days, $hours, $minutes, $seconds] = $this->timeConverter->fromSeconds((int) $workMonth['workingTime']);
            $formattedWorkMonths[$workMonth['month']] = (string) new EvaluationModel(
                hours: $hours,
                minutes: $minutes,
                seconds: $seconds,
            );
        }

        //dd($formattedWorkDays, $formattedWorkMonths);

        return $this->render('evaluation.html.twig', [
            'workTimeByDays' => $formattedWorkDays,
            'workTimeByMonths' => $formattedWorkMonths,
        ]);
    }
}
