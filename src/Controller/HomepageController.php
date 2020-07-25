<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends Controller {

    /**
     * @Route("/", name="index")
     */
    public function index() {
        return $this->render('homepage/index.html.twig', ['mainNavHome'=>true, 'title'=>'Accueil']);
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {
        return $this->render('homepage/index.html.twig', ['mainNavHome'=>true, 'title'=>'Logout']);
    }

}
