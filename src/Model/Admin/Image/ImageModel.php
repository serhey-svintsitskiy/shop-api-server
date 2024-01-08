<?php

namespace App\Model\Admin\Image;

use App\Entity\Image;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Ulid;

class ImageModel
{
    public function __construct(
        public Ulid $id,
        public string $src,
        public string $alt,
        public DateTimeInterface $createdAt,
        public ?DateTimeInterface $updatedAt,
    ) {
    }

    public static function fromEntity(Image $image): self
    {
        return new self(
            $image->getId(),
            $image->getSrc(),
            $image->getAlt(),
            $image->getCreatedAt(),
            $image->getUpdatedAt(),
        );
    }

    /**
     * @param iterable<Image> $list
     * @return self[]
     */
    public static function fromCollection(iterable $list): array
    {
        return array_map(
            fn (Image $image) => self::fromEntity($image),
            iterator_to_array($list)
        );
    }
}
