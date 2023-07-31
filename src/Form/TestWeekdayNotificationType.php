<?php

namespace App\Form;

use App\Enum\Notification;
use App\Enum\Weekdays;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class TestWeekdayNotificationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData']);
    }

    public function onPreSetData(FormEvent $event)
    {
        $weekdayNotifications = $event->getData();
        $form = $event->getForm();
        $dataCollection = [];
        foreach ($weekdayNotifications as $weekdayNotification) {
            $weekday = $weekdayNotification->getWeekday();
            $notification = $weekdayNotification->getNotification();

            $dataCollection[$weekday->value . 'X' . $notification->value] = $weekdayNotification;
        }


        foreach (Weekdays::cases() as $weekday) {
            foreach (Notification::cases() as $notification)
                $form->add(
                    $weekday->value . 'X' . $notification->value,
                    WeekdayNotificationType::class,
                    [
                        'label' => $weekday->name . ' ' . $notification->name,
                        'required' => false,
                        'weekday' => $weekday,
                        'notification' => $notification,
                        'data' => $dataCollection[$weekday->value . 'X' . $notification->value] ?? null,
                    ]
                );
        }
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['weekdays'] = Weekdays::cases();
        $view->vars['notifications'] = Notification::cases();
    }
}