<?php

declare(strict_types=1);

namespace App\Event\Auth;

use App\Entity\User;

readonly class UserRegisteredEvent
{
    public function __construct(
        public User $user,
    ) {
    }
}
