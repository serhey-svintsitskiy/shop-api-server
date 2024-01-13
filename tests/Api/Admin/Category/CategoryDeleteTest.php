<?php

namespace App\Tests\Api\Admin\Category;

use App\DataFixtures\UserFixture;
use App\Entity\Category;
use App\Factory\CategoryFactory;
use App\Model\Admin\Category\CreateRequest;
use App\Repository\Common\CategoryRepository;
use App\Tests\Api\BaseApiTest;

class CategoryDeleteTest extends BaseApiTest
{
    public function testSuccess(): void
    {
        $categoryProxy = CategoryFactory::createOne(['title' => 'category for delete']);

        $client = $this->createAuthorizedClient(UserFixture::ADMIN_1);
        $client->request('DELETE', '/api/admin/categories/' . $categoryProxy->getId());

        $this->assertResponseStatusCodeSame(204);
        $this->assertNull($this->findEntity(Category::class, $categoryProxy->getId()));
    }
}
