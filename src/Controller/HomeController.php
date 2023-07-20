<?php

namespace App\Controller;

use App\Repository\TodoListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TodoListRepository $todoListRepository): Response
    {
        $todoListsHigh = $todoListRepository->findBy(['priority' => 'High']);
        $todoListsMedium = $todoListRepository->findBy(['priority' => 'Medium']);
        $todoListsLow = $todoListRepository->findBy(['priority' => 'Low']);
        return $this->render('home/index.html.twig', [
            "todoListsHigh" => $todoListsHigh,
            "todoListsMedium" => $todoListsMedium,
            "todoListsLow" => $todoListsLow,
        ]);
    }
}
