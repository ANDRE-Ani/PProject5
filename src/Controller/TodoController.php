<?php

namespace App\Controller;

use App\Entity\TaskList;
use App\Form\TodoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TodoController extends AbstractController
{
    /**
     * @Route("/member/todo", name="todo")
     */
    public function index(Request $request)
    {

        $form = $this->createForm(TodoType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $todoFormData = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $TaskList = new TaskList();
            $TaskList->setTask($todoFormData["task"]);
            $entityManager->persist($TaskList);
            $entityManager->flush();

            $this->addFlash('success', 'Tâche ajoutée');

            return $this->redirectToRoute('todo');
        }

        // read all the tasks
        $entityManager = $this->getDoctrine()->getManager();
        $records = $entityManager->getRepository("App\Entity\TaskList")->findAll();

        return $this->render('member/todo.html.twig', [
            'contact_form' => $form->createView(),
            'records' => $records
        ]);
    }


    public function delTask(Request $request, $id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $del = $entityManager->getRepository("App\Entity\TaskList")->find($id);
     
        $entityManager->remove($del);
        $entityManager->flush(); 

        return $this->redirectToRoute('todo');

    }
}
