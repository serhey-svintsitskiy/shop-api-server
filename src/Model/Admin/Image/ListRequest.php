<?php

namespace App\Model\Admin\Image;

use Symfony\Component\Validator\Constraints as Assert;

readonly class ListRequest
{
    public function __construct(
        #[Assert\PositiveOrZero]
        public int $page = 0,
        public ?string $query = null,
    ) {
    }
}