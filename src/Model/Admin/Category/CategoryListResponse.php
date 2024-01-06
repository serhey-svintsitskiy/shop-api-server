<?php

namespace App\Model\Admin\Category;

readonly class CategoryListResponse
{
    /** @param CategoryModel[] $items */
    public function __construct(
        public array $items = [],
    ) {
    }
}
