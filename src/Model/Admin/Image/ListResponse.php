<?php

namespace App\Model\Admin\Image;

readonly class ListResponse
{
    /** @param ImageModel[] $items */
    public function __construct(
        public array $items = [],
    ) {
    }
}
