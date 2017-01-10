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
    
    public function createUser($email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode,
                                $stad, $lengte, $lichaamsbouwId, $hOplNiveauId, $beroep, $etnischeAchtergrondId, $roker,
                                $oogkleurId, $aantalKinderen, $haarkleurId, $foto, $persoonlijkheidsType,
                                $voorkeurGeboorteDatum, $voorkeurLengte, $voorkeurLichaamsbouw, $voorkeurOpleidingsNiveau,
                                $voorkeurRoker, $voorkeurKinderen, $voorkeurPersoonlijkheidsType, $voorkeurGeslacht)                           //verwijst naar functie createUser in daogebruiker.php voor aanmaken gebruiker
    {        
        $GebruikerDAO = new GebruikerDAO();
        $user = $GebruikerDAO->createUser($email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode,
                                $stad, $lengte, $lichaamsbouwId, $hOplNiveauId, $beroep, $etnischeAchtergrondId, $roker,
                                $oogkleurId, $aantalKinderen, $haarkleurId, $foto, $persoonlijkheidsType,
                                $voorkeurGeboorteDatum, $voorkeurLengte, $voorkeurLichaamsbouw, $voorkeurOpleidingsNiveau,
                                $voorkeurRoker, $voorkeurKinderen, $voorkeurPersoonlijkheidsType, $voorkeurGeslacht);
        return $user;
    }    
    
    public function updateUser($id,$email,$paswoord)
    {
        $userDAO = new $UserDAO();
        $user = $UserDAO -> updateUser($id,$email,$paswoord);
        return $user;        
    }
    
    public function deleteUser($id,$email,$paswoord)
    {
        $userDAO = new $UserDAO();
        $user = $UserDAO -> deleteUser($id,$email,$paswoord);
        return $user;        
    }
}
