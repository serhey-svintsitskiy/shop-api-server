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

    public const PREDEFINED_USERS = [
        [
            'email' => self::ADMIN_1,
            'role' => UserRole::ROLE_ADMIN,
            'password' => 'password',
        ],
        [
            'email' => self::ADMIN_2,
            'role' => UserRole::ROLE_ADMIN,
            'password' => 'password',
        ],
        [
            'email' => self::USER_1,
            'role' => UserRole::ROLE_USER,
            'password' => 'password',
        ],
        [
            'email' => self::USER_2,
            'role' => UserRole::ROLE_USER,
            'password' => 'password',
        ],
    ];

    protected function loadData(ObjectManager $manager): void
    {
        $factory = function (User $user, int $i) {
            $predefinedUsers = self::PREDEFINED_USERS;

            $user
                ->setEmail($predefinedUsers[$i]['email'] ?? $this->faker->freeEmail)
                ->setPassword($predefinedUsers[$i]['password'] ?? $this->faker->password)
                ->setRoles([($predefinedUsers[$i]['role'] ?? UserRole::ROLE_USER)->value])
                ->setCreatedAt($this->faker->dateTimeThisYear);
        };
        $this->createMany(User::class, 4, $factory);
        $manager->flush();
    }
}
