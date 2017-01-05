<?php
require_once 'data/GebruikerDAO.php';
class GebruikerService 
{
    public function registreerUser($email, $paswoord)
    {
        //verwijst naar functie registreerGebruiker in daogebruiker.php voor registreren van gebruiker
        $user = new UserDAO();
        $user = $UserDAO->registreerGebruiker($email, $paswoord);
        return $user;
    }
    
    public function toonAlleUsers()
    {
        $UserDAO = new $UserDAO();
        $alleUsers = $UserDAO->getAlleUSers();
     
        return $alleUsers;
        
    }
}

