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
              inner join opleidingsniveaus e on a.hOplNiveauId=e.oplNiveauId
              where a.gebruikerId=:id";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':id'=>$id));
        $rij=$stmt->fetch(PDO::FETCH_ASSOC);
        $voorkeur=Voorkeur::create($id,$rij["voornaam"],$rij["naam"],$rij["oogkleur"],$rij["voorkeurGeboortedatum"],$rij["voorkeurLengte"],
                                    $rij["voorkeurRoker"],$rij["haarkleur"],$rij["etnischeAchtergrond"],$rij["opleidingsNiveau"],$rij["voorkeurGeslacht"],
                                    $rij["voorkeurKinderen"],$rij["voorkeurPersoonlijkheidsType"]);
        $dbh=null;
        return $voorkeur;

    }

    public function getVoorkeurOogkleur($id)
    {
        $sql="SELECT oogkleurId FROM voorkeuroogkleur WHERE gebruikerId=:gebruikerId";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':gebruikerId'=>$id));
        $resultSet=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $dbh=null;
        $lijst=array();
        foreach ($resultSet as $rij)
        {
            $oogkleurId = $rij['oogkleurId'];
            array_push($lijst,$oogkleurId);
        }
        return $lijst;
    }

    public function getVoorkeurHaarkleur($id)
    {
        $sql="SELECT haarkleurId FROM voorkeurhaarkleur WHERE gebruikerId=:gebruikerId";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':gebruikerId'=>$id));
        $resultSet=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $dbh=null;
        $lijst=array();
        foreach ($resultSet as $rij)
        {
            $haarkleurid = $rij['haarkleurId'];
            array_push($lijst,$haarkleurid);
        }
        return $lijst;
    }


    public function getVoorkeurEtniciteit($id)
    {
        $sql="SELECT etnischeAchtergrondId FROM voorkeuretnischeachtergrond WHERE gebruikerId=:gebruikerId";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':gebruikerId'=>$id));
        $resultSet=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $dbh=null;
        $lijst=array();
        foreach ($resultSet as $rij)
        {
            $etn = $rij['etnischeAchtergrondId'];
            array_push($lijst,$etn);
        }
        return $lijst;
    }
    
    //voorkeuren aanpassen
    public function updateUserVoorkeuren($voorkeuren)
    {        
        $sqlVoorkeurenGebruiker = 
                "UPDATE gebruiker set
                voorkeurLengte=:lengte,
                voorkeurOpleidingsNiveau=:opleidingsNiveau,
                voorkeurPersoonlijkheidsType=:persoonlijkheid,
                voorkeurRoker=:roker,
                voorkeurKinderen=:kinderen   
                WHERE gebruikerId=:gebruikerId;
                "; 
        
        $sqlVoorkeurenOogkleuren=
                "DELETE FROM voorkeuroogkleur WHERE gebruikerId = :gebruikerId;
                INSERT INTO voorkeuroogkleur(gebruikerId,oogkleurId)
                VALUES(:gebruikerId,:oogkleurId)
                ";
        
        $sqlVoorkeurenHaarkleuren=
                "DELETE FROM voorkeurhaarkleur WHERE gebruikerId = :gebruikerId;
                INSERT INTO voorkeurhaarkleur(gebruikerId,haarkleurId)
                VALUES(:gebruikerId,:haarkleurId)
                ";
        $sqlVoorkeurenEtnischeAchtergrond=
                "DELETE FROM voorkeuretnischeachtergrond WHERE gebruikerId = :gebruikerId;
                INSERT INTO voorkeurhaarkleur(gebruikerId,etnischeAchtergrondId)
                VALUES(:gebruikerId,:etnischeAchtergrondId)
                ";
        
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sqlVoorkeurenGebruiker);
        $stm2=$dbh->prepare($sqlVoorkeurenOogkleuren);
        $stm3=$dbh->prepare($sqlVoorkeurenHaarkleuren);
        $stm4=$dbh->prepare($sqlVoorkeurenEtnischeAchtergrond);
       
        //voorkeuren gebruiker aanpassen in tabel gebruiker
        $stmt->execute(array( 
            ':voorkeurLengte' => $voorkeuren->getVoorkeurLengte,
            ':voorkeurOpleidingsNiveau'=>$voorkeuren->getOpleidingsNiveau,
            ':voorkeurPersoonlijkheidsType'=>$voorkeuren->getVoorkeurPersoonlijkheidsType,
            ':voorkeurRoker'=>$voorkeuren->getVoorkeurRoker,
            ':voorkeurKinderen'=>$voorkeuren->getVoorkeurKinderen,
            ':gebruikerId'=>$voorkeuren->getGebruikerId            
            ));
        
        //oogkleur voorkeuren aanpassen in tabel voorkeuroogkleur
        foreach ($voorkeuren->getOogkleur as $oogkleur)
        {
         $stm2->execute(array(
            ':gebruikerId'=>$voorkeuren->getGebruikerId,
            ':oogkleurId'=>$oogkleur
         )); 
        }
        
        //haarkleur voorkeuren aanpassen in tabel voorkeurhaarkleur
        foreach ($voorkeuren->getHaarkleur as $haarkleur)
        {
         $stm3->execute(array(
            ':gebruikerId'=>$voorkeuren->getGebruikerId,
            ':haarkleurId'=>$haarkleur
         )); 
        }
        
        //haarkleur voorkeuren aanpassen in tabel voorkeurhaarkleur
        foreach ($voorkeuren->getEtnischeAchtergrond as $etnAchtergrond)
        {
         $stm3->execute(array(
            ':gebruikerId'=>$voorkeuren->getGebruikerId,
            ':etnischeAchtergrondId'=>$etnAchtergrond
         )); 
        }
        
        $dbh=null;
    
    }
}