<?php

namespace App\Model\Admin\Category;

use App\Entity\Category;
use App\Entity\Image;
use DateTimeInterface;
use Symfony\Component\Uid\Ulid;

class CategoryModel
{
    public function __construct(
        public Ulid $id,
        public ?string $title,
        public DateTimeInterface $createdAt,
        public ?DateTimeInterface $updatedAt,
        /** @var Image[] $images */
        public array $images,
    ) {
    }

    public static function fromEntity(Category $category): self
    {
        return new self(
            $category->getId(),
            $category->getTitle(),
            $category->getCreatedAt(),
            $category->getUpdatedAt(),
            iterator_to_array($category->getImages()),
        );
    }

    /**
     * @param Category[] $list
     * @return self[]
     */
    public static function fromCollection(iterable $list): array
    {
        return array_map(
            fn (Category $image) => self::fromEntity($image),
            iterator_to_array($list)
        );
    }
}
