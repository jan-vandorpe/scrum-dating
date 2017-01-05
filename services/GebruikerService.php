<?php
require_once 'data/GebruikerDAO.php';
class GebruikerService 
{
    public function registreerGebruiker($email, $paswoord)
    {
        //verwijst naar functie registreerGebruiker in daogebruiker.php voor registreren van gebruiker
        $gebruiker = new $GebruikerDAO();
        $gebruiker = $GebruikerDAO->registreerGebruiker($email, $paswoord);
        return Gebruiker;
    }
    
    public function toonAlleGebruikers()
    {
        $GebruikerDAO = new $GebruikerDAO();
        $alleGebruikers = $GebruikerDAO->getAlleGebruikers();
     
        return $alleGebruikers;
        
    }
}

