<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Model\LogTimeModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class LogTimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hours', IntegerType::class, [
                'label' => 'Hours',
                'attr' => [
                    'min' => 0,
                    'max' => 24,
                ],
            ])
            ->add('minutes', IntegerType::class, [
                'label' => 'Minutes',
                'attr' => [
                    'min' => 0,
                    'max' => 59,
                ],
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save', 'label' => 'Log time'],
            ])
            ->addModelTransformer(new CallbackTransformer(
                fn (?LogTimeModel $logTimeModel): array => [
                    'hours' => $logTimeModel?->hours ?? 0,
                    'minutes' => $logTimeModel?->minutes ?? 0,
                ],
                fn (array $logTimeModel): LogTimeModel => new LogTimeModel(
                    hours: $logTimeModel['hours'],
                    minutes: $logTimeModel['minutes'],
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
