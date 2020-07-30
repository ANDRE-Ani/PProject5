<?php 
namespace App\Entity; 
use Symfony\Component\Validator\Constraints as Assert;  class Upload { 

   private $fichier; 
      
   public function getFichier() { 
      return $this->fichier; 
   } 
   public function setFichier($fichier) { 
      $this->fichier = $fichier; 
      return $this; 
   } 
} 
