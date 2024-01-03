<?php

declare(strict_types=1);

namespace App\Service\Auth;

use App\Entity\User;
use App\Event\Auth\UserRegisteredEvent;
use App\Model\Auth\SignUpRequest;
use App\Repository\Common\UserRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class SignUpService
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
        private UserRepository $userRepository,
        private EventDispatcherInterface $dispatcher,
    ) {
    }

    public function signUp(SignUpRequest $signUpRequest): User
    {
        if ($this->userRepository->findOneBy(['email' => $signUpRequest->email])) {
            throw new ConflictHttpException('User already exists');
        }

        $user = new User();
        $user
            ->setEmail($signUpRequest->email)
            ->setPassword($this->hasher->hashPassword($user, $signUpRequest->password))
            ->setRoles([]);

        $this->userRepository->save($user, true);

        $this->dispatcher->dispatch(new UserRegisteredEvent($user));

        return $user;
    }
}
