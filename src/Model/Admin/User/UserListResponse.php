<?php

namespace App\Model\Admin\User;

readonly class UserListResponse
{
    /** @param UserModel[] $items */
    public function __construct(
        public array $items = [],
    ) {
    }
}
