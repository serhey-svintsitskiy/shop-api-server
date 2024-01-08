<?php

namespace App\Service\Admin\Product;

use App\Entity\Product;
use App\Model\Admin\Product\CreateRequest;
use App\Repository\Common\ProductRepository;

readonly class CreateService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {
    }

    public function create(CreateRequest $request): Product
    {
        $product = (new Product())
            ->setTitle($request->title);

        $this->productRepository->save($product, true);

        return $product;
    }
}
