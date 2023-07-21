<?php

namespace App\Twig\Components;

use App\Entity\TodoList;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent()]
final class TodoCardComponent
{
    public TodoList $todo_list;
}
