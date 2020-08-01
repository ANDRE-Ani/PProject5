<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/member") */
class MemberController extends Controller
{

    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('member/accueil.html.twig', ['mainNavMember' => true, 'title' => '5Project - Espace Membre']);
    }


    /**
     * @Route("/rss", name="app_project_rss")
     */
    public function rss()
    {
        // url des rss

        $rss = simplexml_load_file('https://www.francetvinfo.fr/france.rss');
        $rss2 = simplexml_load_file('https://www.toolinux.com/spip.php?page=backend');
        $rss3 = simplexml_load_file('https://mrmondialisation.org/feed/');

        return $this->render('member/rss.html.twig', array(
            'rssItems' => $rss->channel->item,
            'rssItems2' => $rss2->channel->item,
            'rssItems3' => $rss3->channel->item,
        ));
    }


    /**
     * @Route("/carte", name="app_project_carte")
     */
    public function carte()
    {
        return $this->render('member/carte.html.twig');
    }

    /**
     * @Route("/mail", name="app_project_mail")
     */
    public function mail()
    {
        return $this->render('member/mail.html.twig');
    }


    /**
     * @Route("/calendrier", name="app_project_calendrier")
     */
    public function calendrier()
    {
        return $this->render('member/calendrier.html.twig');
    }


    /**
     * @Route("/accueil", name="app_project_accueil")
     */
    public function accueil()
    {
        return $this->render('member/accueil.html.twig');
    }
}
