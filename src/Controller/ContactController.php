<?php

namespace App\Controller;

use App\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ContactController extends AbstractController
{
    /**
     * @Route("/member/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {

       $form = $this->createForm(ContactType::class);
       $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()) {

           $contactFormData = $form->getData();

           $message = (new \Swift_Message('Vous avez un message'))
                ->setFrom('andreani.patrice@net-c.fr')
                ->setTo($contactFormData["dest"])
                ->setBody("<br>Sujet :".$contactFormData["sujet"]."<br>Message :".$contactFormData["message"]);
           
           $mailer->send($message);
           
           $this->addFlash('success', 'Message envoyé');

           return $this->redirectToRoute('contact');
       }
       return $this->render('member/mail.html.twig', [
           'our_form' => $form->createView(),
       ]);
    }
}
