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
        $gebruiker = $GebruikerDAO->createUser($email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode,$stad, $voorkeurGeslacht);
        return $gebruiker;
    }
    
    public function getById($id)
    {
        $GebruikerDAO = new GebruikerDao();
        $Gebruiker = $GebruikerDAO ->getById($id);
        return $Gebruiker;        
    }
    
    public function updateUserKenmerken($id,$lengte,$opleidingsNiveau,$persoonlijkheid,$roker,$kinderen,$oogkleur,$haarkleur,$etniciteit)
    {
 
        $GebruikerDAO = new GebruikerDAO();
        $Gebruiker = $GebruikerDAO->getById($id);
        
        $Gebruiker->setLengte($lengte);
        $Gebruiker->setHOplNiveauId($opleidingsNiveau);
        $Gebruiker->setPersoonlijkheidsType($persoonlijkheid);
        $Gebruiker->setRoker($roker);
        $Gebruiker->setAantalKinderen($kinderen);
        $Gebruiker->setOogkleurId($oogkleur);
        $Gebruiker->setHaarkleurId($haarkleur);
        $Gebruiker->setEtnischeAchtergrondId($etniciteit);
        
        $GebruikerDAO->updateUserKenmerken($Gebruiker);              
    }
}
