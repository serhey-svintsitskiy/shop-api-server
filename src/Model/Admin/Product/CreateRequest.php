<?php

namespace App\Model\Admin\Product;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 3, max: 255)]
        /*#[Assert\Regex(pattern: '^[\w\s]+$')]*/
        public string $title,
        #[Assert\NotBlank]
        #[Assert\Length(min: 3, max: 255)]
        public string $sku,
    ) {
    }
}
