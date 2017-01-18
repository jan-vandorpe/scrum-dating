<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 18/01/2017
 * Time: 9:51
 */
//entities/Opleidingsniveau

class Opleidingsniveau
{
    private static $idMap=array();

    private $oplNiveauId;
    private $opleidingsNiveau;

    /**
     * Opleidingsniveau constructor.
     */
    public function __construct($oplNiveauId, $opleidingsNiveau)
    {
        $this->oplNiveauId = $oplNiveauId;
        $this->opleidingsNiveau = $opleidingsNiveau;
    }

    public static function create ($oplNiveauId, $opleidingsNiveau){
        if(!isset(self::$idMap[$oplNiveauId])){
            //als er nog geen object in de database staat met dat id
            self::$idMap[$oplNiveauId]=new Opleidingsniveau($oplNiveauId, $opleidingsNiveau);
        }
        //indien wel al een object met dat id bestaat
        return self::$idMap[$oplNiveauId];
    }

    //GETTERS
    public function getOplNiveauId(){return $this->oplNiveauId;}
    public function getOpleidingsNiveau(){return $this->opleidingsNiveau;}

    //SETTERS
    public function setOpleidingsNiveau($opleidingsNiveau){$this->opleidingsNiveau = $opleidingsNiveau;}



}