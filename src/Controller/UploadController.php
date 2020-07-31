<?php 
namespace App\Controller; 

use App\Entity\Upload; 
use App\Form\FormValidationType; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Service\FileUploader;
use Psr\Log\LoggerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\FileType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  

class UploadController extends AbstractController {    
   /** 
      * @Route("/member/upload", name="app_project_upload") 
   */ 
   public function newAction(Request $request) { 
      $upload = new Upload();
      $form = $this->createFormBuilder($upload) 
         
         ->add('fichier', FileType::class, array(
            'label' => 'Fichier',
            "attr" => array(
                "accept" => "image/*, application/pdf, application/vnd.oasis.opendocument.text, application/vnd.oasis.opendocument.presentation, application/vnd.oasis.opendocument.spreadsheet",
                "multiple" => false,
            )

        ))
         
         ->add('save', SubmitType::class, array('label' => 'Envoyer')) 
         
         ->getForm(); 
         
      $form->handleRequest($request); 
      if ($form->isSubmitted() && $form->isValid()) { 
         $file = $upload->getFichier(); 
         
        $fileName = $file->getClientOriginalName();
         
         $file->move($this->getParameter('photos_directory'), $fileName); 
         $upload->setFichier($fileName); 
             
         $this->addFlash('success', 'Fichier envoyé');
            return $this->redirectToRoute('app_project_upload');
                     
         
      } else { 
      
      
             $files = glob("../public/uploads/*.*");      
            $filenames = array_map('basename', glob('../public/uploads/*.*'));
       
       //$filesize = filesize($file);
      //$filesize = round($filesize / 1024 / 1024, 1);
      
      
      
         return $this->render('/member/upload.html.twig', array( 
            'form' => $form->createView(), 
            'filenames' => $filenames
         ));
         
         
         
      } 
   }   

   
}
