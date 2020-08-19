<?php

namespace App\Controller;

use App\Entity\ToDo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ToDoController extends AbstractController
{

    /**
     * @Route("/member/todo", name="app_project_todo")
     */
    public function createAction(Request $request)
    {
        $afaires = $this->getDoctrine()
        ->getRepository('App:ToDo')
        ->findAll();

        $todo = new Todo;
      
        $form = $this->createFormBuilder($todo)
        ->add('name', TextType::class, array('label'=> 'Tâche', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
        ->add('Save', SubmitType::class, array('label'=> 'Ajouter', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
        ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted() &&  $form->isValid()){
            $name = $form['name']->getData();            
            $now = new\DateTime('now');  
            
            $todo->setName($name);            
            $todo->setCreateDate($now);    
            
            $sn = $this->getDoctrine()->getManager();      
            $sn -> persist($todo);
            $sn -> flush();
            
            $this->addFlash('success', 'Tâche ajoutée');
            return $this->redirectToRoute('app_project_todo');            
           
        }
        
        return $this->render('/member/todo.html.twig', array(
            'form' => $form->createView(),
            'afaires' => $afaires
            
        ));
    }



 /**
     * @Route("/member/todo/delete/{id}", name="app_project_todoD")
     */ 
    public function deleteAction($id)
    {
        
         $sn = $this->getDoctrine()->getManager();
         $todo = $sn->getRepository('App:ToDo')->find($id);
         
         $sn->remove($todo);
         $sn->flush();
        
         $this->addFlash('success', 'Tâche supprimée');
          return $this->redirectToRoute('app_project_todo');             

        }


}
