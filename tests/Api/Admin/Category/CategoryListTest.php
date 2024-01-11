<?php

namespace App\Tests\Api\Admin\Category;

use App\DataFixtures\UserFixture;
use App\Repository\Common\CategoryRepository;
use App\Tests\Api\BaseApiTest;

class CategoryListTest extends BaseApiTest
{
    public function testSomething(): void
    {
        $client = $this->createAuthorizedClient(UserFixture::ADMIN_1);
        $client->request('GET', '/api/admin/categories');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['items' => []]);
    }

    public function testVisitingWhileLoggedIn(): void
    {
        $client = $this->createAuthorizedClient(UserFixture::ADMIN_1);

        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = static::getContainer()->get(CategoryRepository::class);
        $category = $categoryRepository->findOneBy([]);

        $client->request('GET', '/api/admin/categories/' . $category->getId());
        $this->assertResponseIsSuccessful();
        // $this->assertJsonContains(['items' => []]);
    }
}
