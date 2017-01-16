<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 16/01/2017
 * Time: 11:37
 */
class Hobby
{
    private static $idMap=array();

    private $hobbiesId;
    private $hobbies;

    /**
     * hobbies constructor.
     */
    private function __construct($hobbiesId, $hobbies)
    {
        $this->hobbiesId = $hobbiesId;
        $this->hobbies = $hobbies;
    }

    public static function create ($hobbiesId, $hobbies){
        if(!isset(self::$idMap[$hobbiesId])){
            //als er nog geen object in de database staat met dat id
            self::$idMap[$hobbiesId]=new Hobby($hobbiesId, $hobbies);
        }
        //indien wel al een object met dat id bestaat
        return self::$idMap[$hobbiesId];
    }

    //GETTERS
    public function getHobbiesId(){return $this->hobbiesId;}
    public function getHobbies(){return $this->hobbies;}

    //SETTERS
    public function setHobbies($hobbies){$this->hobbies = $hobbies;}

}