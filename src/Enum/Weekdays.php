<?php

namespace App\Enum;

enum Weekdays: string
{
    case MONDAY = 'monday';
    case TUESDAY = 'tuesday';
//    case WEDNESDAY = 'wednesday';
//    case THURSDAY = 'thursday';
//    case FRIDAY = 'friday';
//    case SATURDAY = 'saturday';
//    case SUNDAY = 'sunday';

    public function isEqual(Weekdays $weekdays): bool
    {
        return $this->value === $weekdays->value;
    }
}
