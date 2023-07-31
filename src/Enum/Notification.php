<?php

namespace App\Enum;

enum Notification: string
{
    case FLASH = 'flash';
    case MAIL = 'mail';
}