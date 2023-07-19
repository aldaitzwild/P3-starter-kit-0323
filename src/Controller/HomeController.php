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
        $todoLists = $todoListRepository->findAll();
        return $this->render('home/index.html.twig', [
            "todoLists" => $todoLists,
        ]);
    }
}
