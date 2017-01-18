<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 18/01/2017
 * Time: 9:26
 */
//data/OogkleurDAO.php
require_once ('entities/Oogkleur.php');
class OogkleurDAO
{
    //READ
    //haal alle oogkleuren uit de tabel oogkleuren
    public function getAlleOogkleuren(){

        $sql = "SELECT *
              FROM oogkleuren order by oogkleur asc";
        $dbh = new PDO(DBCONFIG::$DB_CONNSTRING, DBCONFIG::$DB_USERNAME, DBCONFIG::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij){
            $oogkleur=Oogkleur::create($rij['oogkleurId'],$rij["oogkleur"]);
            array_push($lijst,$oogkleur);
        }
        $dbh=null;
        return $lijst;
    }
    //CREATE
    //voeg record toe aan de tabel oogkleuren
    public function createOogkleur($oogkleur){
        $sql="insert into oogkleuren VALUES(:oogkleur) ";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':oogkleur'=>$oogkleur
        ));
        $oogkleurId=$dbh->lastInsertId();
        $dbh=null;
    }
    //DELETE
    //Oogkleur met bepaalde id verwijderen
    public function delete($oogkleurId){
        $sql="delete from oogkleuren where oogkleurId=:id";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':id'=>$oogkleurId));
        $dbh=null;

    }
    //UPDATE
    //Oogkleur met bepaalde id updaten
    public function updateOogkleur($oogkleur){
        $sql="update oogkleuren set oogkleuren=:oogkleur
              where oogkleurId=:id";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':oogkleur'=>$oogkleur->getOogkleur(),
            ':id'=>$oogkleur->getOogkleurId()
        ));
        $dbh=null;
    }

}