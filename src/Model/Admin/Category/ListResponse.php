<?php

namespace App\Model\Admin\Category;

readonly class ListResponse
{
    /** @param CategoryModel[] $items */
    public function __construct(
        public array $items = [],
    ) {
    }
}
