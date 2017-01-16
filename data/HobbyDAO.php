<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 16/01/2017
 * Time: 11:44
 */
//data/HobbyDAO.php
require_once ('entities/Hobby.php');
require_once ('DBCONFIG.php');

class HobbyDAO
{
    //READ
    //haal alle hobbies uit de tabel hobbies
    public function getAlleHobbies(){

        $sql = "SELECT *
              FROM hobbies order by hobbies asc";
        $dbh = new PDO(DBCONFIG::$DB_CONNSTRING, DBCONFIG::$DB_USERNAME, DBCONFIG::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij){
            $hobbies=Hobby::create($rij['hobbiesId'],$rij['hobbies']);
            array_push($lijst,$hobbies);
        }
        $dbh=null;
        return $lijst;
    }
    //CREATE
    //voeg record toe aan de tabel hobbies
    public function createHobby($hobbies){
        $sql="insert into hobbies(hobbies) VALUES(:hobby) ";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':hobby'=>$hobbies
        ));
        $hobbiesId=$dbh->lastInsertId();
        $dbh=null;
    }
    //DELETE
    //Hobby met bepaalde id verwijderen
    public function delete($hobbiesId){
        $sql="delete from hobbies where hobbiesId=:id";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':id'=>$hobbiesId));
        $dbh=null;

    }
    //UPDATE
    //Hobby met bepaalde id updaten
    public function updateHobbies($hobbies){
        $sql="update hobbies set hobbies=:hobbies
              where hobbiesId=:id";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':hobbies'=>$hobbies->getHobbies(),
            ':id'=>$hobbies->getHobbiesId()
        ));
        $dbh=null;
    }

}