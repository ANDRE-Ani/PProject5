<?php
// src/Controller/AdminController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{

  /**
   * @Route("/member/admin", name="app_project_admin")
   */
  public function admin()
  {
    // informations système sur page d'admin
    $version = phpversion();
    $name = $_SERVER['SERVER_NAME'];
    $proto = $_SERVER['SERVER_PROTOCOL'];
    $root = $_SERVER['DOCUMENT_ROOT'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $ipS = $_SERVER['SERVER_ADDR'];
    $nav = $_SERVER['HTTP_USER_AGENT'];

    return $this->render('member/admin.html.twig', array(
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
