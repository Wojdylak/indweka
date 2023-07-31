<?php

namespace App\Form;

use App\Entity\TestWeekdayNotification;
use App\Enum\Notification;
use App\Enum\Weekdays;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeekdayNotificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
            'checked',
            CheckboxType::class,
            [
                'label' => '123',
                'required' => false,
            ]
        )
        ->addEventListener(FormEvents::SUBMIT, [$this, 'onSubmit'])
        ;
    }

    public function onSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        if (null !== $data) {
            $data->setNotification($form->getConfig()->getOption('notification'));
            $data->setWeekday($form->getConfig()->getOption('weekday'));
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TestWeekdayNotification::class,
            'weekday' => null,
            'notification' => null,
        ]);
    }
}