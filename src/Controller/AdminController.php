<?php
// src/Controller/AdminController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{

    /**
    * @Route("/admin/syst", name="app_project_syst")
    */
    public function admin()
    {
      $version = phpversion();
      $name = $_SERVER['SERVER_NAME'];
      $proto = $_SERVER['SERVER_PROTOCOL'];
      $root = $_SERVER['DOCUMENT_ROOT'];
      $ip = $_SERVER['REMOTE_ADDR'];
      $ipS = $_SERVER['SERVER_ADDR'];
      $nav = $_SERVER['HTTP_USER_AGENT'];

      return $this->render('admin/admin.html.twig', array(
          'proto' => $proto,
          'version' => $version,
          'name' => $name,
          'root' => $root,
          'ip' => $ip,
          'nav' => $nav,
          'ipS' => $ipS,
            ));
    }

}
