<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\WorkTime;
use App\Form\Type\LogTimeType;
use App\Transformer\WorkTimeTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
final class LogTimeController extends AbstractController
{
    public function __construct(
        public readonly EntityManagerInterface $entityManager,
        public readonly WorkTimeTransformer $workTimeTransformer,
    )
    {
    }

    #[Route('/', name: 'dashboard', methods: ['GET'])]
    public function list(): Response
    {
        $workTimes = $this->entityManager->getRepository(WorkTime::class)->findAll();

        return $this->render('list.html.twig', [
            'workTimes' => $workTimes,
        ]);
    }

    #[Route('/log-time', name: 'new_log_time', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $form = $this->createForm(LogTimeType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $model = $form->getData();

            $workTime = $this->workTimeTransformer->transformToEntity($model, new WorkTime());
            $this->entityManager->persist($workTime);
            $this->entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('log_time.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/log-time/{id}', name: 'edit_log_time', methods: ['GET', 'POST'])]
    public function edit(Request $request, WorkTime $workTime): Response
    {
        $form = $this->createForm(LogTimeType::class, $this->workTimeTransformer->transformToModel($workTime));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $model = $form->getData();

            $workTime = $this->workTimeTransformer->transformToEntity($model, $workTime);

            $this->entityManager->persist($workTime);
            $this->entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('edit_log_time.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
