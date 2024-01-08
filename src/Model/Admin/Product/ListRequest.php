<?php

namespace App\Model\Admin\Product;

use Symfony\Component\Validator\Constraints as Assert;

readonly class ListRequest
{
    public function __construct(
        #[Assert\PositiveOrZero]
        public int $page = 0,
        #[Assert\Positive]
        public int $count = 10,
        public ?string $query = null,
    ) {
    }
}
