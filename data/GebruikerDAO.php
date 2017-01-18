<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 9/01/2017
 * Time: 9:44
 */
//data/GebruikerDAO.php
require_once ("DBCONFIG.php");
require_once ("entities/Gebruiker.php");

class GebruikerDAO
{
    public function checkLogin($email,$wachtwoord)
    {
       //Kijken als de inloggegevens kloppen, zoja worden de gegevens van die gebruiker doorgegeven

        
        $sql = "SELECT * FROM gebruiker WHERE email = :email";  
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':email' => $email));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC); 
        $dbWachtwoord = $rij['wachtwoord'];
      
        
        $isJuisteWachtwoord = password_verify($wachtwoord, $dbWachtwoord);
        //kijk als er effectief een rij is uit de DB gehaald, false wil zeggen dat de gegevens niet klopten en dus geen resultaten meegeeft
        if ($isJuisteWachtwoord == false) 
        { 
            return $login = false; //login mislukt
        }
        
        //maak nieuw object gebruiker aan met al zijn gegevens uit de rij apart doorgegeven 
        else 
        {  
            $Gebruiker = Gebruiker::create($rij["gebruikerId"], $rij["email"], $rij["geslacht"], $rij["wachtwoord"], $rij["geboorteDatum"], $rij["naam"],
                $rij["voornaam"], $rij["postcode"], $rij["stad"], $rij["lengte"], $rij["lichaamsbouwId"], $rij["hOplNiveauId"],
                $rij["beroep"], $rij["etnischeAchtergrondId"], $rij["roker"], $rij["oogkleurId"], $rij["aantalKinderen"], $rij["haarkleurId"],
                $rij["foto"], $rij["persoonlijkheidsType"], $rij["voorkeurGeboorteDatum"], $rij["voorkeurLengte"], $rij["voorkeurLichaamsbouw"],
                $rij["voorkeurOpleidingsNiveau"], $rij["voorkeurRoker"], $rij["voorkeurKinderen"], $rij["voorkeurPersoonlijkheidsType"], $rij["voorkeurGeslacht"]);
            return $Gebruiker; //doorgeven van het object voor verder gebruik
        }
        $dbh = null; //verbreken van connectie met DB
    }
    

    //READ
    //haal alle gebruikers uit de database Datingsite
    public function getAllUsers()
    {
        $sql = "SELECT *
              FROM gebruiker order by naam asc";
        $dbh = new PDO(DBCONFIG::$DB_CONNSTRING, DBCONFIG::$DB_USERNAME, DBCONFIG::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $gebruiker = Gebruiker::create($rij["gebruikerId"], $rij["email"], $rij["geslacht"], $rij["wachtwoord"], $rij["geboorteDatum"], $rij["naam"],
                $rij["voornaam"], $rij["postcode"], $rij["stad"], $rij["lengte"], $rij["lichaamsbouwId"], $rij["hOplNiveauId"],
                $rij["beroep"], $rij["etnischeAchtergrondId"], $rij["roker"], $rij["oogkleurId"], $rij["aantalKinderen"], $rij["haarkleurId"],
                $rij["foto"], $rij["persoonlijkheidsType"], $rij["voorkeurGeboorteDatum"], $rij["voorkeurLengte"], $rij["voorkeurLichaamsbouw"],
                $rij["voorkeurOpleidingsNiveau"], $rij["voorkeurRoker"], $rij["voorkeurKinderen"], $rij["voorkeurPersoonlijkheidsType"], $rij["voorkeurGeslacht"]);
            array_push($lijst, $gebruiker);
        }
        $dbh = null;
        return $lijst;
    }
    //één specifieke gebruiker ophalen
    public function getById($id){
        $sql="select *
              from gebruiker where gebruikerId=:id";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':id'=>$id));
        $rij=$stmt->fetch(PDO::FETCH_ASSOC);
        $gebruiker=$gebruiker = Gebruiker::create($rij["gebruikerId"], $rij["email"], $rij["geslacht"], $rij["wachtwoord"], $rij["geboorteDatum"], $rij["naam"],
            $rij["voornaam"], $rij["postcode"], $rij["stad"], $rij["lengte"], $rij["lichaamsbouwId"], $rij["hOplNiveauId"],
            $rij["beroep"], $rij["etnischeAchtergrondId"], $rij["roker"], $rij["oogkleurId"], $rij["aantalKinderen"], $rij["haarkleurId"],
            $rij["foto"], $rij["persoonlijkheidsType"], $rij["voorkeurGeboorteDatum"], $rij["voorkeurLengte"], $rij["voorkeurLichaamsbouw"],
            $rij["voorkeurOpleidingsNiveau"], $rij["voorkeurRoker"], $rij["voorkeurKinderen"], $rij["voorkeurPersoonlijkheidsType"], $rij["voorkeurGeslacht"]);
        $dbh=null;
        return $gebruiker;
    }
    //haal wachtwoord uit de database
   public function getPassword($email)
   {
        $sql = "SELECT wachtwoord FROM gebruiker where email = :email";       
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);        
        $stmt->execute(array(':email'=>$email));
        $dbh=null;
           
   }
    //CREATE
    //voeg record toe aan de tabel Gebruikers
    public function createUser($email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode,
                                $stad, $voorkeurGeslacht){

        $sql="insert into gebruiker (email,geslacht,wachtwoord,geboorteDatum,naam,voornaam,postcode,stad,voorkeurGeslacht)
                                      VALUES (:email,:geslacht,:wachtwoord,:geboortedatum,:naam,:voornaam,:postcode,:stad,:vkGeslacht)";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':email'=>$email,
            ':geslacht'=>$geslacht,
            ':wachtwoord'=>$wachtwoord,
            ':geboortedatum'=>$geboorteDatum,
            ':naam'=>$naam,
            ':voornaam'=>$voornaam,
            ':postcode'=>$postcode,
            ':stad'=>$stad,            
            ':vkGeslacht'=>$voorkeurGeslacht
        ));
        $gebruikerId=$dbh->lastInsertId();
        $dbh=null;        
        
    }

    //DELETE
    //gebruiker met bepaalde id verwijderen
    public function delete($gebruikerId){
        $sql="delete from gebruiker where gebruikerId=:id";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':id'=>$gebruikerId));
        $dbh=null;

    }
    //UPDATE
    //gebruiker met bepaalde id updaten
    public function updateUser($gebruiker){
        $sql="update gebruiker set email=:email,geslacht=:geslacht,wachtwoord=:wachtwoord,geboorteDatum=:geboortedatum,naam=:naam,
              voornaam=:voornaam,postcode=:postcode,stad=:stad,lengte=:lengte,lichaamsbouwId=:lichaamsbouwId,hOplNiveauId=:hOplNivId,beroep=:beroep,
              etnischeAchtergrondId=:etnAchId,roker=:roker,oogkleurId=:oogkleurId,aantalKinderen=:aantalKind,haarkleurId=:haarkleurId,foto=:foto,
              persoonlijkheidsType=:persType,voorkeurGeboorteDatum=:vkGeboortedatum,voorkeurLengte:=vkLengte,voorkeurLichaamsbouw=:vkLichBouw,
              voorkeurOpleidingsNiveau=:vkOplNiv,voorkeurRoker=:vkRoker,voorkeurKinderen=:vkKinderen,voorkeurPersoonlijkheidsType=vkPersType,
              voorkeurGeslacht=:vkGeslacht where gebruikerId=:id";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
           ':email'=>$gebruiker->getEmail(),
            ':geslacht'=>$gebruiker->getGeslacht(),
            ':wachtwoord'=>$gebruiker->getWachtwoord(),
            ':geboortedatum'=>$gebruiker->getGeboorteDatum(),
            ':naam'=>$gebruiker->getNaam(),
            ':voornaam'=>$gebruiker->getVoornaam(),
            ':postcode'=>$gebruiker->getPostcode(),
            ':stad'=>$gebruiker->getStad(),
            ':lengte'=>$gebruiker->getLengte(),
            ':lichaamsbouwId'=>$gebruiker->getLichaamsbouwId(),
            ':hOplNivId'=>$gebruiker->getHOplNiveauId(),
            ':beroep'=>$gebruiker->getBeroep(),
            ':etnAchId'=>$gebruiker->getEtnischeAchtergrondId(),
            ':roker'=>$gebruiker->getRoker(),
            ':oogkleurId'=>$gebruiker->getOogkleurId(),
            ':aantalKind'=>$gebruiker->getAantalKinderen(),
            ':haarkleurId'=>$gebruiker->getHaarkleurId(),
            ':foto'=>$gebruiker->getFoto(),
            ':persType'=>$gebruiker->getPersoonlijkheidsType(),
            ':vkGeboortedatum'=>$gebruiker->getVoorkeurGeboorteDatum(),
            ':vkLengte'=>$gebruiker->getVoorkeurLengte(),
            ':vkLichBouw'=>$gebruiker->getVoorkeurLichaamsbouw(),
            ':vkOplNiv'=>$gebruiker->getVoorkeurOpleidingsNiveau(),
            ':vkRoker'=>$gebruiker->getVoorkeurRoker(),
            ':vkKinderen'=>$gebruiker->getVoorkeurKinderen(),
            ':vkPersType'=>$gebruiker->getVoorkeurPersoonlijkheidsType(),
            ':vkGeslacht'=>$gebruiker->getVoorkeurGeslacht(),
            ':id'=>$gebruiker->getGebruikerId()));

        $dbh=null;
    }


}