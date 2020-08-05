<?php

namespace App\Controller;

use App\Entity\Upload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class UploadController extends AbstractController
{
   /** 
    * @Route("/member/upload", name="app_project_upload") 
    */
   public function newAction(Request $request)
   {
      // formulaire pour envoi de fichier
      $upload = new Upload();
      $form = $this->createFormBuilder($upload)

         ->add('fichier', FileType::class, array(
            'label' => 'Fichier à envoyer',
            "attr" => array(
               "accept" => "image/*, application/pdf, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.presentation, application/vnd.oasis.opendocument.spreadsheet",
               "multiple" => false,
            )
         ))
         ->add('save', SubmitType::class, array('label' => 'Envoyer'))
         ->getForm();

      // recuperation des informations sur les fichiers
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
         $file = $upload->getFichier();
         $fileName = $file->getClientOriginalName();
         $file->move($this->getParameter('photos_directory'), $fileName);
         $upload->setFichier($fileName);

         $this->addFlash('success', 'Fichier envoyé');
         return $this->redirectToRoute('app_project_upload');
      } else {

         // recuperation nom des fichiers et nombre
         $filenames = array_map('basename', glob('../public/uploads/*.*'));
         $folderPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
         $files2 = glob($folderPath . '*.*');

         // compte le nombre de fichiers
         if ($files2 !== false) {
            $filecount = count($files2);
         }

         // taille du répertoire
         $files = scandir('../public/uploads/');
         foreach ($files as $file) {
            $sizeFK = filesize('../public/uploads/' . $file);
            $sizeFB = ($sizeFK / 1024 / 1024);
            $sizeF = number_format($sizeFB, 2);
         } 

         return $this->render('/member/upload.html.twig', array(
            'form' => $form->createView(),
            'filenames' => $filenames,
            'filecount' => $filecount,
            'sizeF' => $sizeF
         ));
      }
   }


   /** 
    * @Route("/member/uploadDelete", name="app_project_upload_delete") 
    */
   public function deleteAction(Request $request)
   {

      $file = $_GET['fichier'];
      unlink('../public/uploads/'.$file);
      $this->addFlash('success', 'Fichier supprimé');
      return $this->redirectToRoute('app_project_upload');
   }
}
