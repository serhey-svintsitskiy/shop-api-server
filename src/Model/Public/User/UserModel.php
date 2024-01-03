<?php

namespace App\Model\Public\User;

use App\Entity\User;
use DateTimeInterface;
use Symfony\Component\Uid\Ulid;

class UserModel
{
    public function __construct(
        public Ulid $id,
        public ?string $email,
        public DateTimeInterface $createdAt,
        public ?DateTimeInterface $updatedAt,
    ) {
    }

    public static function fromEntity(User $user): self
    {
        return new self(
            $user->getId(),
            $user->getEmail(),
            $user->getCreatedAt(),
            $user->getUpdatedAt(),
        );
    }
}
