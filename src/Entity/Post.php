<?php

namespace App\Entity;

use App\DTO\Post as PostDTO;
use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

class Post
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string|null
     */
    private ?string $text;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     * @return Post
     */
    public function setText(?string $text): Post
    {
        $this->text = $text;
        return $this;
    }

    public static function fromPostDTO(PostDTO $dto, self $post = null): self
    {
        if (null === $post) {
            $post = new self();
        }

        return $post
            ->setText($dto->text)
            ->setTitle($dto->title)
        ;
    }
}
