<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 18/01/2017
 * Time: 9:18
 */
//entities/Oogkleur.php
class Oogkleur
{
    private static $idMap=array();

    private $oogkleurId;
    private $oogkleur;

    /**
     * Oogkleur constructor.
     */
    public function __construct($oogkleurId, $oogkleur)
    {
        $this->oogkleurId = $oogkleurId;
        $this->oogkleur = $oogkleur;
    }

    public static function create ($oogkleurId, $oogkleur){
        if(!isset(self::$idMap[$oogkleurId])){
            //als er nog geen object in de database staat met dat id
            self::$idMap[$oogkleurId]=new Oogkleur($oogkleurId, $oogkleur);
        }
        //indien wel al een object met dat id bestaat
        return self::$idMap[$oogkleurId];
    }

    //GETTERS
    public function getOogkleurId(){return $this->oogkleurId;}
    public function getOogkleur(){return $this->oogkleur;}

    //SETTERS
    public function setOogkleur($oogkleur)
    {
        $this->oogkleur = $oogkleur;
    }

}