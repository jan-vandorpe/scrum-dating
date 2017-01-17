<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 16/01/2017
 * Time: 12:40
 */
//data/HaarkleurDAO.php
require_once ('entities/Haarkleur.php');
require_once ('DBCONFIG.php');

class HaarkleurDAO
{
    //READ
    //haal alle haarkleuren uit de tabel haarkleuren
    public function getAlleHaarkleuren(){

        $sql = "SELECT *
              FROM haarkleuren order by haarkleur asc";
        $dbh = new PDO(DBCONFIG::$DB_CONNSTRING, DBCONFIG::$DB_USERNAME, DBCONFIG::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij){
            $haarkleur=Haarkleur::create($rij['haarkleurId'],$rij['haarkleur']);
            array_push($lijst,$haarkleur);
        }
        $dbh=null;
        return $lijst;
    }
    //CREATE
    //voeg record toe aan de tabel haarkleuren
    public function createHaarkleur($haarkleur){
        $sql="insert into haarkleuren VALUES(:haarkleur) ";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':haarkleur'=>$haarkleur
        ));
        $haarkleurId=$dbh->lastInsertId();
        $dbh=null;
    }
    //DELETE
    //Haarkleur met bepaalde id verwijderen
    public function delete($haarkleurId){
        $sql="delete from haarkleuren where haarkleurId=:id";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':id'=>$haarkleurId));
        $dbh=null;

    }
    //UPDATE
    //Haarkleur met bepaalde id updaten
    public function updateHaarkleur($haarkleur){
        $sql="update haarkleuren set haarkleuren=:haarkleur
              where haarkleurId=:id";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':haarkleur'=>$haarkleur->getHaarkleur(),
            ':id'=>$haarkleur->getHaarkleurId()
        ));
        $dbh=null;
    }
}