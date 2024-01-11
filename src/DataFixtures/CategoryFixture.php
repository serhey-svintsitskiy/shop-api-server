<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends BaseFixture
{
    protected function loadData(ObjectManager $manager): void
    {
        $factory = function (Category $category, int $i) {
            $category
                ->setTitle(sprintf('test category %\'.02d', $i))
                ->setCreatedAt(new \DateTimeImmutable(sprintf('-%d days', rand(1, 100))));
        };

        $this->createMany(Category::class, 11, $factory);
        $manager->flush();
    }
}
