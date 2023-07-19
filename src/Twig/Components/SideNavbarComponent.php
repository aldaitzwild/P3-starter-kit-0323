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
    public function getTodoLists(): array
    {
        return $this->todoListRepository->findAll();
    }
}
