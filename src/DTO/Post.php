<?php

namespace App\DTO;

use App\Entity\Post as Entity;

final class Post
{
    public ?string $title = null;

    public ?string $text = null;

    public static function fromEntity(Entity $post): self
    {
        $dto = new self();
        $dto->title = $post->getTitle();
        $dto->text = $post->getText();

        return $dto;
    }
}