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
require_once ("entities/Opleidingsniveau.php");

class GebruikerDAO
{
    public function checkLogin($email,$wachtwoord)
    {
       //Kijken als de inloggegevens kloppen, zoja worden de gegevens van die gebruiker doorgegeven

        
        $sql = "SELECT gebruikerId,wachtwoord FROM gebruiker WHERE email = :email";  
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql); 
        $stmt->execute(array(':email' => $email));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC); 
        $dbWachtwoord = $rij['wachtwoord'];
      
        
        $isJuisteWachtwoord = password_verify($wachtwoord, $dbWachtwoord);      
        
        if ($isJuisteWachtwoord == false) 
        { 
            return $login = false; //login mislukt
        }      
        else 
        {  
            return $login = $rij['gebruikerId']; //login gelukt  
        }
        $dbh = null; //verbreken van connectie met DB
    }
    

    //READ
    //haal alle gebruikers uit de database Datingsite
    public function getAllUsers()
    {
        $sql = "SELECT *
              FROM gebruiker order by naam ASC ";
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
        $gebruiker = Gebruiker::create($rij["gebruikerId"], $rij["email"], $rij["geslacht"], $rij["wachtwoord"], $rij["geboorteDatum"], $rij["naam"],
            $rij["voornaam"], $rij["postcode"], $rij["stad"], $rij["lengte"], $rij["lichaamsbouwId"], $rij["hOplNiveauId"],
            $rij["beroep"], $rij["etnischeAchtergrondId"], $rij["roker"], $rij["oogkleurId"], $rij["aantalKinderen"], $rij["haarkleurId"],
            $rij["foto"], $rij["persoonlijkheidsType"], $rij["voorkeurGeboorteDatum"], $rij["voorkeurLengte"], $rij["voorkeurLichaamsbouw"],
            $rij["voorkeurOpleidingsNiveau"], $rij["voorkeurRoker"], $rij["voorkeurKinderen"], $rij["voorkeurPersoonlijkheidsType"], $rij["voorkeurGeslacht"]);
        $dbh=null;
        return $gebruiker;
    }
    public function getVoorkeurenGebruiker($id){
        $sql="select a.gebruikerId,a.voornaam,a.naam,b.oogkleur,a.voorkeurGeboortedatum,
              a.voorkeurLengte,a.voorkeurRoker,c.haarkleur,d.etnischeAchtergrond,
              e.opleidingsNiveau,a.voorkeurGeslacht,a.voorkeurKinderen,a.voorkeurPersoonlijkheidsType
              FROM gebruiker a
              inner join (voorkeuroogkleur f inner join oogkleuren b
                          on f.oogkleurId=b.oogkleurId)
			              on a.gebruikerId=f.gebruikerId
              inner join(voorkeurhaarkleur j inner join haarkleuren c
                          on j.haarkleurId=c.haarkleurId)
		                  on a.gebruikerId=j.gebruikerId
              inner join (voorkeuretnischeachtergrond k inner join etnischeachtergronden d
                          on k.etnischeAchtergrondId=d.etnischeAchtergrondId)
			              on a.gebruikerId=k.gebruikerId
              inner join opleidingsniveaus e on a.hOplNiveauId=e.oplNiveauId
              where a.gebruikerId=:id";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':id'=>$id));
        $rij=$stmt->fetch(PDO::FETCH_ASSOC);
        $dbh=null;

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

    public function getUserKenmerken()
    {
        $sql="select gebruikerId,oogkleurId,lengte,roker,haarkleurId,etnischeAchtergrondId,hOplNiveauId,geslacht,
              aantalKinderen,persoonlijkheidsType
              from gebruiker ";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array());
        $resultSet=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $dbh=null;
        $lijst=array();

        foreach ($resultSet as $rij)
        {
            $gebruikerId = $rij['gebruikerId'];
            $oogkleurId = $rij['oogkleurId'];
            $lengte = $rij['lengte'];
            $roker = $rij['roker'];
            $haarkleur = $rij['haarkleurId'];
            $etn = $rij['etnischeAchtergrondId'];
            $oplNiveau = $rij['hOplNiveauId'];
            $geslacht = $rij['geslacht'];
            $kinderen = $rij['aantalKinderen'];
            $persoonlijkheidsType = $rij['persoonlijkheidsType'];

            $kenmerken=array();

            array_push($kenmerken, $oogkleurId, $lengte, $roker, $haarkleur, $etn, $oplNiveau, $geslacht, $kinderen, $persoonlijkheidsType);
            // array_push($lijst, $kenmerken);

            //print_r($kenmerken);

            //array_push($lijst[$gebruikerId], $kenmerken);

            $lijst[$gebruikerId] = $kenmerken;




        }


        return $lijst;


    }
    //kenmerken updaten
    public function updateUserKenmerken($gebruiker)
    {    

        $sql="update gebruiker set     
            lengte=:lengte,
            hOplNiveauId=:opleidingsNiveau,
            persoonlijkheidsType=:persoonlijkheid,
            roker=:roker,
            aantalKinderen=:kinderen,
            oogkleurId=:oogkleur,
            haarkleurId=:haarkleur,
            etnischeAchtergrondId=:etniciteit 
            WHERE gebruikerId=:gebruikerId";
            
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);    
       
       
          $stmt->execute(array(   
            ':gebruikerId' => (int)$gebruiker->getGebruikerId(),
            ':lengte'=>(int)$gebruiker->getLengte(),
            ':opleidingsNiveau'=>(int)$gebruiker -> getOpleidingsNiveau()->getOplNiveauId(),
            ':persoonlijkheid'=>(int)$gebruiker->getPersoonlijkheidsType(),
            ':roker'=>(int)$gebruiker->getRoker(),
            ':kinderen'=>(int)$gebruiker->getAantalKinderen(),
            ':oogkleur'=>(int)$gebruiker->getOogkleur()->getOogkleurId(),
            ':haarkleur'=>(int)$gebruiker->getHaarkleur()->getHaarkleurId(),
            ':etniciteit'=>(int)$gebruiker->getEtnischeAchtergrond()->getEtnischeAchtergrondId()
            ));
        
        $dbh=null;
    }
    
    //wachtwoord wijzigen
    
    public function updateWachtwoord($gebruiker)
    {
        $sql="update gebruiker set 
            wachtwoord=:wachtwoord
            WHERE gebruikerId=:gebruikerId
            ";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
   
         
        $stmt->execute(array(   
           ':gebruikerId' => (int)$gebruiker->getGebruikerId(),
           ':wachtwoord'=>password_hash($gebruiker->getWachtwoord(),PASSWORD_DEFAULT)
           ));
         
         $dbh=null;      
    }

    public function updateUserFoto($gebruiker)
    {

        $sql="update gebruiker set     
            foto=:foto
            WHERE gebruikerId=:gebruikerId";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);


        $stmt->execute(array(
            ':gebruikerId' => (int)$gebruiker->getGebruikerId(),
            ':foto'=>(string)$gebruiker->getFoto()
        ));

        $dbh=null;
    }


}
