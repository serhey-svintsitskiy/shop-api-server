<?php

namespace App\Model\Public\User;

readonly class UserListResponse
{
    /** @param UserModel[] $items */
    public function __construct(
        public array $items = [],
    ) {
    }
}
