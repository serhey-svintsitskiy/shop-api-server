<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Symfony\Bundle\Test\Client;
use App\Repository\Common\UserRepository;

abstract class BaseApiTest extends ApiTestCase
{
    public function createAuthorizedClient(string $userEmail): Client
    {
        /** @var UserRepository $userRepository */
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneBy(['email' => $userEmail]);

        $client = static::createClient();
        $client->loginUser($testUser);

        return $client;
    }
}
