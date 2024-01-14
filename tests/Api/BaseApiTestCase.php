<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Symfony\Bundle\Test\Client;
use App\Repository\Common\UserRepository;
use Symfony\Component\Uid\Ulid;

abstract class BaseApiTestCase extends ApiTestCase
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

    /**
     * @template T of object
     * @param class-string<T> $class
     * @param Array<mixed> $criteria
     * @return T|null
     */
    public function findEntityBy(string $class, array $criteria)
    {
        return static::getContainer()->get('doctrine')->getRepository($class)->findOneBy($criteria);
    }

    /**
     * @template T of object
     * @param class-string<T> $class
     * @return T|null
     */
    public function findEntity(string $class, Ulid|string|int $id)
    {
        return static::getContainer()->get('doctrine')->getRepository($class)->find($id);
    }
}
