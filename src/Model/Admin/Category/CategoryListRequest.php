<?php

namespace App\Model\Admin\Category;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CategoryListRequest
{
    public function __construct(
        #[Assert\PositiveOrZero]
        public int $page = 0,
        public ?string $query = null,
    ) {
    }
}
