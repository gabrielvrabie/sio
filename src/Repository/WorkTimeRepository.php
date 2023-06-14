<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\WorkTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class WorkTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkTime::class);
    }

    /**
     * @desc Get total working time grouped by day
     * @return array<array-key, array{createdAt: \DateTimeInterface, workingTime: string}>
     */
    public function getWorkingTimeGroupedByDay()
    {
        $queryBuilder = $this->createQueryBuilder('workTime');
        $queryBuilder
            ->select('SUM(workTime.time) as workingTime', 'DATE_FORMAT(workTime.createdAt, \'%Y-%m-%d\') as day')
            ->groupBy('day')
            ->orderBy('day', 'ASC')
        ;

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @desc Get total working time grouped by month
     * @return array<array-key, array{createdAt: \DateTimeInterface, workingTime: string}>
     */
    public function getWorkingTimeGroupByMonth()
    {
        $queryBuilder = $this->createQueryBuilder('workTime');
        $queryBuilder
            ->select('SUM(workTime.time) as workingTime, DATE_FORMAT(workTime.createdAt, \'%Y-%m\') as month')
            ->groupBy('month')
            ->orderBy('month', 'ASC')
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
