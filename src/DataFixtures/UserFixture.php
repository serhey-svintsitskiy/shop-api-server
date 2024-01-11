<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Model\Auth\UserRole;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends BaseFixture
{
    public const ADMIN_1 = 'admin1@test.com';
    public const ADMIN_2 = 'admin2@test.com';
    public const USER_1 = 'user1@test.com';
    public const USER_2 = 'user2@test.com';

    protected function loadData(ObjectManager $manager): void
    {
        $factory = function (User $user, int $i) {
            $roles = [UserRole::ROLE_ADMIN, UserRole::ROLE_ADMIN];
            $role = $roles[$i] ?? UserRole::ROLE_USER;
            $emails = [self::ADMIN_1, self::ADMIN_2, self::USER_1, self::USER_2];
            $user
                ->setEmail($emails[$i] ?? $this->faker->freeEmail)
                ->setPassword($this->faker->password)
                ->setRoles([$role->value])
                ->setCreatedAt($this->faker->dateTimeThisYear);
        };
        $this->createMany(User::class, 4, $factory);
        $manager->flush();
    }
}
