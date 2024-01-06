<?php

namespace App\Service\Admin\Category;

use App\Entity\Category;
use App\Repository\Common\CategoryRepository;

readonly class DeleteCategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {
    }

    public function delete(Category $category): void
    {
        $this->categoryRepository->remove($category, true);
    }
}
