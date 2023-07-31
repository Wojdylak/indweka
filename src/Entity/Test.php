<?php

namespace App\Entity;

use App\Enum\Weekdays;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Test
{
    private int $id;

    private string $title;

    private Collection $testWeekdayNotifications;

    public function __construct()
    {
        $this->testWeekdayNotifications = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTestWeekdayNotifications(): Collection
    {
        return $this->testWeekdayNotifications;
    }

    public function addTestWeekdayNotification(TestWeekdayNotification $testWeekdayNotification): void
    {
        if (false === $this->testWeekdayNotifications->contains($testWeekdayNotification)) {
            $this->testWeekdayNotifications->add($testWeekdayNotification);
            $testWeekdayNotification->setTest($this);
        }
    }

    public function removeTestWeekdayNotification(TestWeekdayNotification $testWeekdayNotification): void
    {
        $this->testWeekdayNotifications->removeElement($testWeekdayNotification);
    }

}