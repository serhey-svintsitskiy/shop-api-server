<?php

namespace App\Tests\Api\Admin\Category;

use App\DataFixtures\UserFixture;
use App\Model\Admin\Category\CreateRequest;
use App\Tests\Api\BaseApiTest;

class CategoryCreateTest extends BaseApiTest
{
    public function testSuccess(): void
    {
        $requestData = new CreateRequest('new test category 1');

        $client = $this->createAuthorizedClient(UserFixture::ADMIN_1);
        $client->request('POST', '/api/admin/categories', ['json' => $requestData]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(201);
    }

    public function testFailedValidation(): void
    {
        $requestData = new CreateRequest('');

        $client = $this->createAuthorizedClient(UserFixture::ADMIN_1);
        $client->request('POST', '/api/admin/categories', ['json' => $requestData]);

        $this->assertResponseIsUnprocessable();
        $this->assertResponseStatusCodeSame(422);
    }

}
