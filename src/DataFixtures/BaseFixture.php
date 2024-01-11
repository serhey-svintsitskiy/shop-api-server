<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{
    private ObjectManager $manager;

    protected Generator $faker;

    abstract protected function loadData(ObjectManager $manager): void;

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->faker = Factory::create();
        $this->loadData($manager);
    }

    protected function getReferenceName(string $className, int $index): string
    {
        return sprintf('%s_%\'.09d', $className, $index);
    }

    protected function createMany(string $className, int $count, callable $factory): void
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = new $className();
            $factory($entity, $i);
            $this->manager->persist($entity);
            // store for usage later as App\Entity\ClassName_#COUNT#
            $this->addReference($this->getReferenceName($className, $i), $entity);
        }
    }
}
