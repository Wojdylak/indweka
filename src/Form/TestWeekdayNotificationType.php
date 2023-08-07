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

        foreach (Weekdays::cases() as $weekday) {
            foreach (Notification::cases() as $notification) {
                $form->add(
                    $weekday->value . 'X' . $notification->value,
                    WeekdayNotificationType::class,
                    [
                        'row' => $weekday,
                        'row_field_name' => 'weekday',
                        'column' => $notification,
                        'column_field_name' => 'notification',
                        'collection' => $weekdayNotifications,
                    ]
                );
            }
        }
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['weekdays'] = Weekdays::cases();
        $view->vars['notifications'] = Notification::cases();
    }
}
