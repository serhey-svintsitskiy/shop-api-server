<?php

namespace App\Service\Admin\Product;

use App\Entity\Category;
use App\Repository\Common\ProductRepository;

readonly class DeleteService
{
    public function __construct(
        private ProductRepository $productRepository,
    ) {
    }

    public function delete(Category $category): void
    {
        $this->productRepository->remove($category, true);
    }
}
