<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 11/01/2017
 * Time: 9:45
 */
//entities/etnischeAchtergrond.php

class etnischeAchtergrond {

    private static $idMap=array();

    //alle attributen van de tabel etnischeAchtergrond
    private $etnischeAchtergrondId;
    private $etnischeAchtergrond;

    /**
     * etnischeAchtergrond constructor.
     */
    private function __construct($etnischeAchtergrondId,$etnischeAchtergrond){

        $this->etnischeAchtergrondId=$etnischeAchtergrondId;
        $this->etnischeAchtergrond=$etnischeAchtergrond;
    }

    public static function create ($etnischeAchtergrondId,$etnischeAchtergrond){
        if(!isset(self::$idMap[$etnischeAchtergrondId])){
            //als er nog geen object in de database staat met dat id
            self::$idMap[$etnischeAchtergrondId]=new etnischeAchtergrond($etnischeAchtergrondId,$etnischeAchtergrond);
        }
        //indien wel al een object met dat id bestaat
        return self::$idMap[$etnischeAchtergrondId];
    }

    //GETTERS
    public function getEtnischeAchtergrondId(){return $this->etnischeAchtergrondId;}
    public function getEtnischeAchtergrond(){return $this->etnischeAchtergrond;}

    //SETTERS
    public function setEtnischeAchtergrond($etnischeAchtergrond)
    {
        $this->etnischeAchtergrond = $etnischeAchtergrond;
    }

}