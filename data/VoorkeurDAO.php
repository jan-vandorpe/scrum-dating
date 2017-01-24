<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 23/01/2017
 * Time: 11:34
 */
//data/VoorkeurDAO.php
require_once ('entities/Voorkeur.php');
require_once ('entities/Oogkleur.php');
require_once ('entities/Haarkleur.php');
require_once ('entities/etnischeAchtergrond.php');
require_once ('entities/Opleidingsniveau.php');
require_once ('DBCONFIG.php');

class VoorkeurDAO
{
    public function getVoorkeurenAlleGebruikers (){
        $sql="select a.gebruikerId,a.voornaam,a.naam,b.oogkleur,b.oogkleurId,a.voorkeurGeboortedatum,
              a.voorkeurLengte,a.voorkeurRoker,c.haarkleur,c.haarkleurId,d.etnischeAchtergrond,d.etnischeAchtergrondId,
              e.opleidingsNiveau,e.oplNiveauId,a.voorkeurGeslacht,a.voorkeurKinderen,a.voorkeurPersoonlijkheidsType
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
              inner join opleidingsniveaus e on a.hOplNiveauId=e.oplNiveauId";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $resultSet=$dbh->query($sql);
        $lijst=array();
        foreach ($resultSet as $rij){
            $oogkleur=Oogkleur::create($rij["oogkleurId"],$rij["oogkleur"]);
            $haarkleur=Haarkleur::create($rij["haarkleurId"],$rij["haarkleur"]);
            $opleiding=Opleidingsniveau::create($rij["oplNiveauId"],$rij["opleidingsNiveau"]);
            $etnachtergrond=etnischeAchtergrond::create($rij["etnischeAchtergrondId"],$rij["etnischeAchtergrond"]);
            $voorkeur=Voorkeur::create($rij["gebruikerId"],$rij["voornaam"],$rij["naam"],$oogkleur,$rij["voorkeurGeboortedatum"],
                                        $rij["voorkeurLengte"],$rij["voorkeurRoker"],$haarkleur,$etnachtergrond,$opleiding,$rij["voorkeurGeslacht"],
                                        $rij["voorkeurKinderen"],$rij["voorkeurPersoonlijkheidsType"]);
            array_push($lijst,$voorkeur);
        }
        $dbh=null;
        return $lijst;

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
    
    //voorkeuren aanpassen
    public function updateUserVoorkeuren($voorkeuren)
    {
        $sql = "update gebruiker set
            voorkeurLengte=:lengte,
            voorkeurOpleidingsNiveau=:opleidingsNiveau,
            voorkeurPersoonlijkheidsType=:persoonlijkheid,
            voorkeurRoker=:roker,
            voorkeurKinderen=:kinderen           
            ";        
        
        
        
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
    
    }
}