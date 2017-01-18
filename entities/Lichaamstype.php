<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 18/01/2017
 * Time: 9:35
 */
//entities/Lichaamstype.php

class Lichaamstype
{
    private static $idMap=array();

    private $lichaamstypeId;
    private $lichaamstype;

    /**
     * Lichaamstype constructor.
     */
    public function __construct($lichaamstypeId, $lichaamstype)
    {
        $this->lichaamstypeId = $lichaamstypeId;
        $this->lichaamstype = $lichaamstype;
    }

    public static function create ($lichaamstypeId, $lichaamstype){
        if(!isset(self::$idMap[$lichaamstypeId])){
            //als er nog geen object in de database staat met dat id
            self::$idMap[$lichaamstypeId]=new Oogkleur($lichaamstypeId, $lichaamstype);
        }
        //indien wel al een object met dat id bestaat
        return self::$idMap[$lichaamstypeId];
    }

    //GETTERS
    public function getLichaamstypeId(){return $this->lichaamstypeId;}
    public function getLichaamstype(){return $this->lichaamstype;}

    //SETTERS
    public function setLichaamstype($lichaamstype){$this->lichaamstype = $lichaamstype;}

}