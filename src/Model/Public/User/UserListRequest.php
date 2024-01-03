<?php

namespace App\Model\Public\User;

use Symfony\Component\Validator\Constraints as Assert;

readonly class UserListRequest
{
    public function __construct(
        #[Assert\PositiveOrZero]
        public int $page = 0,
        public ?string $query = null,
    ) {
    }
}
