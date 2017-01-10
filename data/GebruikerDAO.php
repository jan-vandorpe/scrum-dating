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
    //CREATE
    //voeg record toe aan de tabel Gebruikers
    public function createUser($email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode,
                                $stad, $lengte, $lichaamsbouwId, $hOplNiveauId, $beroep, $etnischeAchtergrondId, $roker,
                                $oogkleurId, $aantalKinderen, $haarkleurId, $foto, $persoonlijkheidsType,
                                $voorkeurGeboorteDatum, $voorkeurLengte, $voorkeurLichaamsbouw, $voorkeurOpleidingsNiveau,
                                $voorkeurRoker, $voorkeurKinderen, $voorkeurPersoonlijkheidsType, $voorkeurGeslacht){

        $sql="insert into gebruiker (email,geslacht,wachtwoord,geboorteDatum,naam,voornaam,postcode,stad,
                                      lengte,lichaamsbouwId,hOplNiveauId,beroep,etnischeAchtergrondId,roker,oogkleurId,aantalKinderen,
                                      haarkleurId,foto,persoonlijkheidsType,voorkeurGeboorteDatum,voorkeurLengte,voorkeurLichaamsbouw,voorkeurOpleidingsNiveau,
                                      voorkeurRoker,voorkeurKinderen,voorkeurPersoonlijkheidsType,voorkeurGeslacht)
                                      VALUES (:email,:geslacht,:wachtwoord,:geboortedatum,:naam,:voornaam,:postcode,:stad,:lengte,:lbouwId,
                                      :hOpNivId,:beroep,:etnAchId,:roker,:oogkleurId,:aantalkind,:haarkleurId,:foto,:persType,:vkGeboortedatum,:vkLengte,
                                      :vkLichaamsbouw,:vkOplNiv,:vkRoker,:vkKinderen,:vkPersType,:vkGeslacht)";
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
            ':lengte'=>$lengte,
            ':lbouwId'=>$lichaamsbouwId,
            ':hOpNivId'=>$hOplNiveauId,
            ':beroep'=>$beroep,
            ':etnAchId'=>$etnischeAchtergrondId,
            ':roker'=>$roker,
            ':oogkleurId'=>$oogkleurId,
            ':aantalkind'=>$aantalKinderen,
            ':haarkleurId'=>$haarkleurId,
            ':foto'=>$foto,
            ':persType'=>$persoonlijkheidsType,
            ':vkGeboortedatum'=>$voorkeurGeboorteDatum,
            ':vkLengte'=>$voorkeurLengte,
            ':vkLichaamsbouw'=>$voorkeurLichaamsbouw,
            ':vkOplNiv'=>$voorkeurOpleidingsNiveau,
            ':vkRoker'=>$voorkeurRoker,
            ':vkKinderen'=>$voorkeurKinderen,
            ':vkPersType'=>$voorkeurPersoonlijkheidsType,
            ':vkGeslacht'=>$voorkeurGeslacht
        ));
        $gebruikerId=$dbh->lastInsertId();
        $dbh=null;
        $gebruiker=Gebruiker::create($gebruikerId,$email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode,
                                $stad, $lengte, $lichaamsbouwId, $hOplNiveauId, $beroep, $etnischeAchtergrondId, $roker,
                                $oogkleurId, $aantalKinderen, $haarkleurId, $foto, $persoonlijkheidsType,
                                $voorkeurGeboorteDatum, $voorkeurLengte, $voorkeurLichaamsbouw, $voorkeurOpleidingsNiveau,
                                $voorkeurRoker, $voorkeurKinderen, $voorkeurPersoonlijkheidsType, $voorkeurGeslacht);
        return $gebruiker;
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