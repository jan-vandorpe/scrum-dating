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
        $sql = "SELECT gebruikersId,email,geslacht,wachtwoord,geboorteDatum,naam,voornaam,postcode,
              stad,lengte,lichaamsbouw,OplNiveauId,beroep,etnischeAchtergrond,roker,oogkleurId,
              aantalKinderen,haarkleurId,foto,persoonlijkheidsType,voorkeurGeboorteDatum,
              voorkeurLengte,voorkeurLichaamsbouw,voorkeurOpleidingsniveau,voorkeurRoker,voorkeurKinderen,
              voorkeurPersoonlijk,voorkeurGeslacht
              FROM gebruikers order by naam asc";
        $dbh = new PDO(DBCONFIG::$DB_CONNSTRING, DBCONFIG::$DB_USERNAME, DBCONFIG::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $gebruiker = Gebruiker::create($rij["gebruikersId"], $rij["email"], $rij["geslacht"], $rij["wachtwoord"], $rij["geboorteDatum"], $rij["naam"],
                $rij["voornaam"], $rij["postcode"], $rij["stad"], $rij["lengte"], $rij["lichaamsbouw"], $rij["hOplNiveauId"],
                $rij["beroep"], $rij["etnischeAchtergrond"], $rij["roker"], $rij["oogkleurId"], $rij["aantalKinderen"], $rij["haarkleurId"],
                $rij["foto"], $rij["persoonlijkheidsType"], $rij["voorkeurGeboorteDatum"], $rij["voorkeurLengte"], $rij["voorkeurLichaamsbouw"],
                $rij["voorkeurOpleidingsniveau"], $rij["voorkeurRoker"], $rij["voorkeurKinderen"], $rij["voorkeurPersoonlijk"], $rij["voorkeurGeslacht"]);
            array_push($lijst, $gebruiker);
        }
        $dbh = null;
        return $lijst;

    }

}