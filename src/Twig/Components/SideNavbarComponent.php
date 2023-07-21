<?php

namespace App\Twig\Components;

use App\Repository\TodoListRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent()]
final class SideNavbarComponent
{
    public function __construct(
        public TodoListRepository $todoListRepository
    ) {
    }
    public function getTodoListsHigh(): array
    {
        return $this->todoListRepository->findBy(['priority' => 'High']);
    }

    public function getTodoListsMedium(): array
    {
        return $this->todoListRepository->findBy(['priority' => 'Medium']);
    }

    public function getTodoListsLow(): array
    {
        return $this->todoListRepository->findBy(['priority' => 'Low']);
    }
}
