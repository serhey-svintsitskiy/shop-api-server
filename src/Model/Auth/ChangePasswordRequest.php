<?php

declare(strict_types=1);

namespace App\Model\Auth;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePasswordRequest
{
    public function __construct(
        #[Assert\NotBlank(allowNull: false)]
        #[SecurityAssert\UserPassword(
            message: 'Wrong value for your current password',
        )]
        public string $currentPasswd,
        #[Assert\NotBlank(allowNull: false)]
        #[Assert\Length(min: 8)]
        public string $newPasswd,
        #[Assert\NotBlank(allowNull: false)]
        #[Assert\Length(min: 8)]
        #[Assert\EqualTo(propertyPath: 'newPasswd', message: 'Password confirmation must match the new password')]
        public string $confirmNewPasswd,
    ) {
    }
}
