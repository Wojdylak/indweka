<?php

namespace App\Entity;

use App\Enum\Notification;
use App\Enum\Weekdays;

class TestWeekdayNotification
{
    private int $id;
    private Test $test;

    private Notification $notification;

    private Weekdays $weekday;

    private bool $checked;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTest(): Test
    {
        return $this->test;
    }

    public function setTest(Test $test): void
    {
        $this->test = $test;
    }

    public function getNotification(): Notification
    {
        return $this->notification;
    }

    public function setNotification(Notification $notification): void
    {
        $this->notification = $notification;
    }

    public function getWeekday(): Weekdays
    {
        return $this->weekday;
    }

    public function setWeekday(Weekdays $weekday): void
    {
        $this->weekday = $weekday;
    }

    public function isChecked(): bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): void
    {
        $this->checked = $checked;
    }
}