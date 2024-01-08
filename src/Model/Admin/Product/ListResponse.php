<?php

namespace App\Model\Admin\Product;

readonly class ListResponse
{
    /** @param ProductModel[] $items */
    public function __construct(
        public array $items = [],
    ) {
    }
}
