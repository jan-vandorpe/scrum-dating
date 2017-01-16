<?php
require_once 'data/GebruikerDAO.php';
class GebruikerService 
{
    public function toonAlleUsers()                                             
    {
        $GebruikerDAO = new GebruikerDAO();
        $alleUsers = $GebruikerDAO->getAllUsers();     
        return $alleUsers;        
    }
    public function checkLogin($email, $wachtwoord)
    {     
        $GebruikerDAO = new GebruikerDAO();
        $gebruiker = $GebruikerDAO->checkLogin($email, $wachtwoord);
        return $gebruiker;
    }
    
    public function createUser($email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode,
                                $stad,$voorkeurGeslacht)                           //verwijst naar functie createUser in daogebruiker.php voor aanmaken gebruiker
    {        
        $GebruikerDAO = new GebruikerDAO();
        $user = $GebruikerDAO->createUser($email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode,$stad, $voorkeurGeslacht);
        return $user;
    }
}
