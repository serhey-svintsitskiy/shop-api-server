<?php

namespace App\Tests\Admin\Category;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class CategoryListTest extends ApiTestCase
{
    public function testSomething(): void
    {
        static::createClient()->request('GET', '/api/admin/categories');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['items' => []]);
    }
}
