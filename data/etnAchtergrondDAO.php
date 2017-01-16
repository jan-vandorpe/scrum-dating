<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 16/01/2017
 * Time: 9:32
 */
//data/etnAchtergrondDAO.php
require_once ('entities/etnischeAchtergrond.php');
require_once ('DBCONFIG.php');

class etnAchtergrondDAO{

    //READ
    //haal alle etnische achtergronden uit de tabel etnische Achtergrond
    public function getAlleAchtergronden(){

        $sql = "SELECT *
              FROM etnischeachtergronden order by etnischeAchtergrond asc";
        $dbh = new PDO(DBCONFIG::$DB_CONNSTRING, DBCONFIG::$DB_USERNAME, DBCONFIG::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij){
            $etnAchtergrond=etnischeAchtergrond::create($rij["etnischeAchtergrondId"],$rij["etnischeAchtergrond"]);
            array_push($lijst,$etnAchtergrond);
        }
        $dbh=null;
        return $lijst;
    }

    //CREATE
    //voeg record toe aan de tabel etnischeachtergronden
    public function createEtnAchtergrond($etnischeAchtergrond){
        $sql="insert into etnischeachtergronden(etnischeAchtergrond) VALUES(:Achtergrond) ";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
           ':Achtergrond'=>$etnischeAchtergrond
        ));
        $etnAchtergrondId=$dbh->lastInsertId();
        $dbh=null;
    }
    //DELETE
    //etnische achtergrond met bepaalde id verwijderen
    public function delete($etnAchtergrondId){
        $sql="delete from etnischeachtergronden where etnischeAchtergrondId=:id";
        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(':id'=>$etnAchtergrondId));
        $dbh=null;

    }
    //UPDATE
    //etnische achtergrond met bepaalde id updaten
    public function updateEtnAchtergrond($etnAchtergrond){
        $sql="update etnischeachtergronden set etnischeAchtergrond=:etnAchtergrond
              where etnischeAchtergrondId=:id";

        $dbh=new PDO(DBCONFIG::$DB_CONNSTRING,DBCONFIG::$DB_USERNAME,DBCONFIG::$DB_PASSWORD);
        $stmt=$dbh->prepare($sql);
        $stmt->execute(array(
            ':etnAchtergrond'=>$etnAchtergrond->getEtnischeAchtergrond(),
            ':id'=>$etnAchtergrond->getEtnischeAchtergrondId()
        ));
        $dbh=null;
    }

}