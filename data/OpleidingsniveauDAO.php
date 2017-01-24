<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 18/01/2017
 * Time: 9:55
 */
//data/OpleidingsniveauDAO.php
require_once ('entities/Opleidingsniveau.php');

class OpleidingsniveauDAO
{
    //READ
    //haal alle opleidingsniveaus uit de tabel opleidingsniveaus
    public function getAlleOpleidingsniveaus(){

        $sql = "SELECT *
              FROM opleidingsniveaus order by opleidingsNiveau asc";
        $dbh = new PDO(DBCONFIG::$DB_CONNSTRING, DBCONFIG::$DB_USERNAME, DBCONFIG::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij){
            $opleidingsniveau=Opleidingsniveau::create($rij['oplNiveauId'],$rij["opleidingsNiveau"]);
            array_push($lijst,$opleidingsniveau);
        }
        $dbh=null;
        return $lijst;
    }
    //haal een specifiek opleidingsniveau op
    public function getOpleidingsNiveauById($id){
        $sql='select opleidingsNiveau from opleidingsniveaus where oplNiveauId=:id';
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':id'=>$id
        ));
        $rij=$stmt->fetch(PDO::FETCH_ASSOC);
        $opleidingsniveau=Opleidingsniveau::create($id,$rij["opleidingsNiveau"]);
        $dbh=null;
        return $opleidingsniveau;

    }
    //CREATE
    //voeg record toe aan de tabel opleidingsniveaus
    public function createOpleidingsniveau($opleidingsniveau){
        $sql="insert into opleidingsniveaus VALUES(:opleidingsNiveau) ";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':opleidingsNiveau'=>$opleidingsniveau
        ));
        $oplNiveauId=$dbh->lastInsertId();
        $dbh=null;
    }
    //DELETE
    //Opleidingsniveau met bepaalde id verwijderen
    public function delete($oplNiveauId){
        $sql="delete from opleidingsniveaus where oplNiveauId=:id";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':id'=>$oplNiveauId));
        $dbh=null;

    }
    //UPDATE
    //Opleidingsniveau met bepaalde id updaten
    public function updateOpleidingsniveau($opleidingsniveau){
        $sql="update opleidingsniveaus set opleidingsNiveau=:opleidingsniveau
              where oplNiveauId=:id";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':opleidingsniveau'=>$opleidingsniveau->getOpleidingsniveau(),
            ':id'=>$opleidingsniveau->getOpleidingsniveauId()
        ));
        $dbh=null;
    }

}