<?php

namespace App\Enum;

enum Notification: string
{
    case FLASH = 'flash';
    case MAIL = 'mail';

    public function isEqual(Notification $notification): bool
    {
        return $this->value === $notification->value;
    }
}
