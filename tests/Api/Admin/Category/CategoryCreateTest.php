<?php

namespace App\Tests\Api\Admin\Category;

use App\DataFixtures\UserFixture;
use App\Model\Admin\Category\CreateRequest;
use App\Tests\Api\BaseApiTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class CategoryCreateTest extends BaseApiTestCase
{
    public function testSuccess(): void
    {
        $requestData = new CreateRequest('new test category 1');

        $client = $this->createAuthorizedClient(UserFixture::ADMIN_1);
        $client->request('POST', '/api/admin/categories', ['json' => $requestData]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(201);
    }

    #[DataProvider(methodName: 'requestDataProvider')]
    public function testFailedValidation(): void
    {
        $requestData = new CreateRequest('');

        $client = $this->createAuthorizedClient(UserFixture::ADMIN_1);
        $client->request('POST', '/api/admin/categories', ['json' => $requestData]);

        $this->assertResponseIsUnprocessable();
        $this->assertResponseStatusCodeSame(422);
    }

    public static function requestDataProvider(): iterable
    {
        yield [new CreateRequest('')];
        yield [new CreateRequest('aa')];
    }

}
