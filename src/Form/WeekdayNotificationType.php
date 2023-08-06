<?php

namespace App\Form;

use App\Entity\TestWeekdayNotification;
use App\Enum\Notification;
use App\Enum\Weekdays;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class WeekdayNotificationType extends AbstractType
{
    private PropertyAccessorInterface $propertyAccessor;

    public function __construct(PropertyAccessorInterface $propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

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
        $data = $event->getData();
        $collection = $event->getForm()->getConfig()->getOption('collection');
        if (false === $data->isChecked()) {
            $collection->removeElement($data);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => TestWeekdayNotification::class,
                'label' => function (Options $options) {
                    $row = $options['row'];
                    $column = $options['column'];

                    return $row->name . ' ' . $column->name;
                },
                'required' => false,
                'mapped' => false,
                'data' => function (Options $options) {
                    $collection = $options['collection'];
                    $optionRow = $options['row'];
                    $rowFieldName = $options['row_field_name'];
                    $optionColumn = $options['column'];
                    $columnFieldName = $options['column_field_name'];

                    foreach ($collection as $item) {
                        $row = $this->propertyAccessor->getValue($item, $rowFieldName);
                        $column = $this->propertyAccessor->getValue($item, $columnFieldName);
                        if ($row->isEqual($optionRow) && $column->isEqual($optionColumn)) {
                            return $item;
                        }
                    }

                    $element = new $options['data_class']();
                    $this->propertyAccessor->setValue($element, $rowFieldName, $optionRow);
                    $this->propertyAccessor->setValue($element, $columnFieldName, $optionColumn);
                    $collection->add($element);

                    return $element;
                }
            ])
            ->setRequired([
                'row',
                'row_field_name',
                'column',
                'column_field_name',
                'collection',
            ])
            ->setAllowedTypes('row', \UnitEnum::class)
            ->setAllowedTypes('row_field_name', 'string')
            ->setAllowedTypes('column', \UnitEnum::class)
            ->setAllowedTypes('column_field_name', 'string')
            ->setAllowedTypes('collection', Collection::class)
        ;
    }
}
