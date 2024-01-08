<?php

namespace App\Model\Admin\Product;

use App\Entity\Product;
use App\Model\Admin\Category\CategoryModel;
use App\Model\Admin\Image\ImageModel;
use DateTimeInterface;
use Symfony\Component\Uid\Ulid;

class ProductModel
{
    /**
     * @param Ulid $id
     * @param string $title
     * @param string $sku
     * @param ImageModel[] $images
     * @param CategoryModel[] $categories
     * @param DateTimeInterface $createdAt
     * @param DateTimeInterface|null $updatedAt
     */
    public function __construct(
        public Ulid $id,
        public string $title,
        public string $sku,
        public array $images,
        public array $categories,
        public DateTimeInterface $createdAt,
        public ?DateTimeInterface $updatedAt,
    ) {
    }

    public static function fromEntity(Product $product): self
    {
        return new self(
            $product->getId(),
            $product->getTitle(),
            $product->getSku(),
            ImageModel::fromCollection($product->getImages()),
            CategoryModel::fromCollection($product->getCategories()),
            $product->getCreatedAt(),
            $product->getUpdatedAt(),
        );
    }

    /**
     * @param Product[] $list
     * @return self[]
     */
    public static function fromCollection(iterable $list): array
    {
        return array_map(
            fn (Product $image) => self::fromEntity($image),
            iterator_to_array($list)
        );
    }
}
