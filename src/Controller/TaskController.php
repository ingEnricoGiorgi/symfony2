<?php 
// src/Controller/TaskController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Type\TaskType;
use App\Entity\Task;
use App\Entity\Dipendenti;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class TaskController extends AbstractController 
{

     /**
     * @Route("nuovoform", name="nuovoform")
     */

    public function new(ManagerRegistry $doctrine, Request $request): Response
    {
        // creates a task object and initializes some data for this example
        //$task = new Task();
       //..

        $form = $this->createForm(TaskType::class);
        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $task = $form->getData();

        //inizio transazione database

        $entityManager = $doctrine->getManager();

        $dipendente = new Dipendenti();
        $dipendente->setNome($task['nome']);
        $dipendente->setEmail($task['email']);

        $entityManager->persist($dipendente);
        $entityManager->flush();

    // ... perform some action, such as saving the task to the database
        print_r($task);
        exit;

        return $this->redirectToRoute('task_success');
    }
            return $this->renderForm('task/new.html.twig', [
            'form' => $form
    ]);
        // ...
    }
}