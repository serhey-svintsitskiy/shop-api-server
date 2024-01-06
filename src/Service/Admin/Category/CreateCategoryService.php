<?php

namespace App\Service\Admin\Category;

use App\Entity\Category;
use App\Model\Admin\Category\CreateRequest;
use App\Repository\Common\CategoryRepository;

readonly class CreateCategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepository
    ) {
    }

    public function create(CreateRequest $request): Category
    {
        $category = (new Category())
            ->setTitle($request->title);

        $this->categoryRepository->save($category, true);

        return $category;
    }
}
