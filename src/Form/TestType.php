<?php

namespace App\Form;

use App\Entity\Market;
use App\Entity\Test;
use App\Entity\TestMarketStandard;
use App\Entity\TestWeekdayNotification;
use App\Enum\Weekdays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'required' => false,
                ]
            )
            ->add(
                'testWeekdayNotifications',
                TestWeekdayNotificationType::class,
                [
                    'mapped' => true,
                    'by_reference' => false,
                ]
            )
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Test::class,
        ]);
    }
}