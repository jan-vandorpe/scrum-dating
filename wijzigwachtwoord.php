<?php
session_start();
require_once 'services/GebruikerService.php';
require_once 'entities/Gebruiker.php';

if (isset($_POST['wwWijzigen']))
{    
 
    $gebruikerId = $_SESSION['gebruikerId'];
    
    $oudWachtwoord = $_POST['oudWW'];
    $nieuwWachtwoord = $_POST['nieuwWW'];
    $nieuwWachtwoord2 = $_POST['nieuwWW2'];
    
    $gebService = new GebruikerService();
    $gebruiker = $gebService -> getById($gebruikerId);
    
  
    $email= $gebruiker->getEmail();
    
    $gebSvc = new GebruikerService();
    $loginCheck = $gebSvc->checkLogin($email, $oudWachtwoord);
   
    if($loginCheck == true)
    {
  
        if($nieuwWachtwoord == $nieuwWachtwoord2)
        {
            
                $gebSvc = new GebruikerService();
                $gebSvc->updateWachtwoord($gebruikerId, $nieuwWachtwoord);
        }
    }
      header('Location: ' . $_SERVER['HTTP_REFERER']);
}
    