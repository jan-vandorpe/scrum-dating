<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 16/01/2017
 * Time: 12:36
 */
//entities/Haarkleur.php

class Haarkleur
{
    private static $idMap=array();

    private $haarkleurId;
    private $haarkleur;

    /**
     * Haarkleur constructor.
     */
    public function __construct($haarkleurId, $haarkleur)
    {
        $this->haarkleurId = $haarkleurId;
        $this->haarkleur = $haarkleur;
    }

    public static function create ($haarkleurId, $haarkleur){
        if(!isset(self::$idMap[$haarkleurId])){
            //als er nog geen object in de database staat met dat id
            self::$idMap[$haarkleurId]=new Haarkleur($haarkleurId, $haarkleur);
        }
        //indien wel al een object met dat id bestaat
        return self::$idMap[$haarkleurId];
    }

    //GETTERS
    public function getHaarkleurId(){return $this->haarkleurId;}
    public function getHaarkleur(){return $this->haarkleur;}

    //SETTERS
    public function setHaarkleur($haarkleur)
    {
        $this->haarkleur = $haarkleur;
    }

}