<?php
require_once 'DBConfig.php';

class Gebruiker {

    public function maakGebruiker($email,$paswoord) 
    {
        $sql = "insert into gebruikers(email, paswoord) values (:email, :paswoord)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh = new PDO("mysql:host=192.168.0.21;dbname=datingsite;charset=utf8", "root", "vdab");
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':email' => $email, ':paswoord' => $paswoord));
        $dbh = null;
    }

}
