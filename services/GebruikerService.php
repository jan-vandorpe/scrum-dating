<?php
require_once 'data/GebruikerDAO.php';
class GebruikerService 
{
    public function createUser($id,$email, $paswoord)                           //verwijst naar functie createUser in daogebruiker.php voor aanmaken gebruiker
    {        
        $user = new UserDAO();
        $user = $UserDAO->createUser($id,$email, $paswoord);
        return $user;
    }
    
    public function toonAlleUsers()                                             
    {
        $GebruikerDAO = new GebruikerDAO();
        $alleUsers = $GebruikerDAO->getAllUsers();     
        return $alleUsers;        
    }
    
    public function updateUser($id,$email,$paswoord)
    {
        $userDAO = new $UserDAO();
        $user = $UserDAO -> updateUser($id,$email,$paswoord);
        return $user;
    }
}

