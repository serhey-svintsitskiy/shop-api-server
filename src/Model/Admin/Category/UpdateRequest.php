<?php

namespace App\Model\Admin\Category;

use Symfony\Component\Validator\Constraints as Assert;

readonly class UpdateRequest
{
    public function __construct(
        #[Assert\Length(min: 3, max: 255)]
        /*#[Assert\Regex(pattern: '^[\w\s]+$')]*/
        public string $title,
    ) {
    }
}
