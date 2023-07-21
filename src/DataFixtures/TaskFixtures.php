<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TaskFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // $product = new Product();
        // $manager->persist($product);

        for ($i = 1; $i <= 75; $i++) {
            $task = new Task();
            $task->setContent($faker->sentence(rand(3, 20)));
            $task->setCompleted(rand(0, 1));
            $task->setTodoList($this->getReference('Todo' . rand(1, 10)));

            $manager->persist($task);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TodoListFixtures::class,
        ];
    }
}
