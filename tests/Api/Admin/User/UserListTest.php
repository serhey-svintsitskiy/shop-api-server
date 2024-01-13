<?php

namespace App\Tests\Api\Admin\User;

use App\DataFixtures\UserFixture;
use App\Repository\Common\CategoryRepository;
use App\Repository\Common\UserRepository;
use App\Tests\Api\BaseApiTest;

class UserListTest extends BaseApiTest
{
    public function testSomething(): void
    {
        $client = $this->createAuthorizedClient(UserFixture::ADMIN_1);
        $client->request('GET', '/api/admin/users');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['items' => []]);
    }

    public function testVisitingWhileLoggedIn(): void
    {
        $client = $this->createAuthorizedClient(UserFixture::ADMIN_1);

        /** @var UserRepository $userRepository */
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneBy([]);

        $client->request('GET', '/api/admin/users/' . $user->getId());
        $this->assertResponseIsSuccessful();
        // $this->assertJsonContains(['items' => []]);
    }
}
