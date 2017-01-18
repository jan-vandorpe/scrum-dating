<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 18/01/2017
 * Time: 9:39
 */
//data/LichaamstypeDAO.php
require_once ('entities/Lichaamstype.php');

class LichaamstypeDAO
{
    //READ
    //haal alle lichaamstypes uit de tabel lichaamstypes
    public function getAlleLichaamstypes(){

        $sql = "SELECT *
              FROM lichaamstypes order by lichaamstype asc";
        $dbh = new PDO(DBCONFIG::$DB_CONNSTRING, DBCONFIG::$DB_USERNAME, DBCONFIG::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij){
            $lichaamstype=Lichaamstype::create($rij['lichaamstypeId'],$rij['lichaamstype']);
            array_push($lijst,$lichaamstype);
        }
        $dbh=null;
        return $lijst;
    }
    //CREATE
    //voeg record toe aan de tabel lichaamstypes
    public function createLichaamstype($lichaamstype){
        $sql="insert into lichaamstypes VALUES(:lichaamstype) ";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':lichaamstype'=>$lichaamstype
        ));
        $lichaamstypeId=$dbh->lastInsertId();
        $dbh=null;
    }
    //DELETE
    //Lichaamstype met bepaalde id verwijderen
    public function delete($lichaamstypeId){
        $sql="delete from lichaamstypes where lichaamstypeId=:id";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':id'=>$lichaamstypeId));
        $dbh=null;

    }
    //UPDATE
    //Lichaamstype met bepaalde id updaten
    public function updateLichaamstype($lichaamstype){
        $sql="update lichaamstypes set lichaamstype=:lichaamstype
              where lichaamstypeId=:id";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':lichaamstype'=>$lichaamstype->getLichaamstype(),
            ':id'=>$lichaamstype->getLichaamsId()
        ));
        $dbh=null;
    }


}