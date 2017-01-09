<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 5/01/2017
 * Time: 10:26
 */
//entities/Gebruiker.php


class Gebruiker {

    private static $idMap=array();

    private $id;
    private $email;
    private $wachtwoord;
    /**aanvullen met alle andere definitieve attributen in de tabel Gebruiker

    /**
     * Gebruiker constructor.
     * de constructor function is private zodat er van buiten de klasse Gebruiker
     * geen nieuw Gebruiker-object meer aangemaakt kan worden
     */
    private function __construct($id,$email,$wachtwoord)
    {
        $this->id=$id;
        $this->email=$email;
        $this->wachtwoord=$wachtwoord;
    }

    //de aanmaak van een nieuw Gebruikerobject gebeurt door de create functie
    //die eerst controleert of er nog geen Gebruiker-object met dit id bestaat
    public static function create($id,$email,$wachtwoord){
        if(!isset(self::$idMap[$id])){
            self::$idMap[$id]=new Gebruiker($id,$email,$wachtwoord);
        }
        return self::$idMap[$id];
    }

    //getters
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getWachtwoord()
    {
        return $this->wachtwoord;
    }

    //setters
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setWachtwoord($wachtwoord)
    {
        $this->wachtwoord = $wachtwoord;
    }

    //setter voor id hangt af van het feit dat id auto-increment is of niet




}
