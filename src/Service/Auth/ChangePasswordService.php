<?php

declare(strict_types=1);

namespace App\Service\Auth;

use App\Entity\User;
use App\Model\Auth\ChangePasswordRequest;
use App\Repository\Common\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class ChangePasswordService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $hasher,
    ) {
    }

    public function changePassword(User $user, ChangePasswordRequest $request): User
    {
        $user->setPassword($this->hasher->hashPassword($user, $request->newPasswd));
        $this->userRepository->save($user, true);

        return $user;
    }
}
