<?php

namespace App\Model\Admin\Category;

use App\Entity\Category;
use DateTimeInterface;
use Symfony\Component\Uid\Ulid;

class CategoryModel
{
    public function __construct(
        public Ulid $id,
        public ?string $title,
        public DateTimeInterface $createdAt,
        public ?DateTimeInterface $updatedAt,
    ) {
    }

    public static function fromEntity(Category $category): self
    {
        return new self(
            $category->getId(),
            $category->getTitle(),
            $category->getCreatedAt(),
            $category->getUpdatedAt(),
        );
    }
}
