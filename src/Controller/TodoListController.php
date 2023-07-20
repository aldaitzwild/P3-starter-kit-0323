<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\TodoList;
use App\Form\TodoListType;
use App\Repository\TaskRepository;
use App\Repository\TodoListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/todoList', name: 'todo_list_')]
class TodoListController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(TodoListRepository $todoListRepository): Response
    {
        return $this->render('todo_list/index.html.twig', [
            'todo_lists' => $todoListRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $todoList = new TodoList();
        $form = $this->createForm(TodoListType::class, $todoList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($todoList);
            $entityManager->flush();

            return $this->redirectToRoute('todo_list_show', ['id' => $todoList->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('todo_list/new.html.twig', [
            'todo_list' => $todoList,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(TodoList $todoList, Request $request, TaskRepository $taskRepository): Response
    {
        $taskContent = $request->get('content');
        if (!empty($taskContent)) {
            $task = new Task();
            $task->setTodoList($todoList);
            $task->setContent($taskContent);
            $task->setCompleted(false);

            $taskRepository->save($task, true);
            $this->addFlash('success', "New task added");
        }

        $taskCompleted = $request->get('completed');
        if (!empty($taskCompleted)) {
            $task = $taskRepository->find($taskCompleted);
            $task->setCompleted(true);

            $taskRepository->save($task, true);
        }

        $taskUnCompleted = $request->get('unCompleted');
        if (!empty($taskUnCompleted)) {
            $task = $taskRepository->find($taskUnCompleted);
            $task->setCompleted(false);

            $taskRepository->save($task, true);
        }

        return $this->render('todo_list/show.html.twig', [
            'todo_list' => $todoList,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TodoList $todoList, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TodoListType::class, $todoList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('todo_list_show', ['id' => $todoList->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('todo_list/edit.html.twig', [
            'todo_list' => $todoList,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, TodoList $todoList, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $todoList->getId(), $request->request->get('_token'))) {
            $entityManager->remove($todoList);
            $entityManager->flush();
            $this->addFlash('success', 'To-do List deleted');
        }
        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
