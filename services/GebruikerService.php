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
    
    public function updateWachtwoord($id,$nieuwWachtwoord)
    {
        $GebruikerDAO = new GebruikerDAO();
        $Gebruiker = $GebruikerDAO->getById($id);
        
        
        $Gebruiker->getGebruikerId($id);
        $Gebruiker->setWachtwoord($nieuwWachtwoord);
        
        
        $GebruikerDAO->updateWachtwoord($Gebruiker);
        
        
    }
    
    public function getById($id)
    {
        $GebruikerDAO = new GebruikerDao();
        $Gebruiker = $GebruikerDAO ->getById($id);
        return $Gebruiker;        
    }

    public function getUserKenmerken()
    {
        $GebruikerDAO = new GebruikerDao();
        $lijst = $GebruikerDAO->getUserKenmerken();

        return $lijst;

    }
    
    public function updateUserKenmerken($id,$lengte,$opleidingsNiveauId,$persoonlijkheid,$roker,$kinderen,$oogkleurId,$haarkleurId,$etniciteitId)
    {
 
        $GebruikerDAO = new GebruikerDAO();
        $Gebruiker = $GebruikerDAO->getById($id);
        
        $Gebruiker->setLengte($lengte);
        //tussenstap om het opleidingsNiveauObject te bekomen
        $opleidingsNiveauSvc=new OpleidingsniveauService();
        $opleidingsNiveau=$opleidingsNiveauSvc->getOpleidingsNiveauById($opleidingsNiveauId);
        $oogkleurSvc=new OogkleurService();
        $oogkleur=$oogkleurSvc->getOogkleurById($oogkleurId);
        $haarkleurSvc=new HaarkleurService();
        $haarkleur=$haarkleurSvc->getHaarkleurById($haarkleurId);
        $etniciteitSvc=new etnAchtergrondService();
        $etniciteit=$etniciteitSvc->getEtniciteitById($etniciteitId);

        $Gebruiker->setOpleidingsNiveau($opleidingsNiveau);
        $Gebruiker->setPersoonlijkheidsType($persoonlijkheid);
        $Gebruiker->setRoker($roker);
        $Gebruiker->setAantalKinderen($kinderen);
        $Gebruiker->setOogkleur($oogkleur);
        $Gebruiker->setHaarkleur($haarkleur);
        $Gebruiker->setEtnischeAchtergrond($etniciteit);
        
        $GebruikerDAO->updateUserKenmerken($Gebruiker);
        //header('Location: ' . 'index.php');
    }
    public function toonGebruiker($id){
        $gebruikerDAO=new GebruikerDAO();
        $gebruiker=$gebruikerDAO->getById($id);
        return $gebruiker;
    }
    public function updateUserFoto($id,$foto)
    {

        $GebruikerDAO = new GebruikerDAO();
        $Gebruiker = $GebruikerDAO->getById($id);

        $Gebruiker->setFoto($foto);


        $GebruikerDAO->updateUserFoto($Gebruiker);
        //header('Location: ' . 'index.php');
    }
    public function getMatches($id){
        //zoek matches voor de gebruiker
        //@$id=gebruikerId
         $voorkeurSvc=new VoorkeurService();
        $voorkeurGebruiker=$voorkeurSvc->getVoorkeurenGebruiker($id);
         $kenmerkenGebruikers=self::getUserKenmerken(); //een ARRAY

        //return $voorkeurenGebruiker;



    }


}
