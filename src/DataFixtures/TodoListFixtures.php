<?php

namespace App\DataFixtures;

use App\Entity\TodoList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TodoListFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $priority = [
            'High',
            'Medium',
            'Low',
        ];

        for ($i = 1; $i <= 10; $i++) {
            $todoList = new TodoList();
            $todoList->setTitle($faker->sentence());
            $todoList->setPriority($priority[array_rand($priority)]);

            $manager->persist($todoList);
            $this->addReference('Todo' . $i, $todoList);
        }

        $manager->flush();
    }
}
