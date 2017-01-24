<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 23/01/2017
 * Time: 11:06
 */
//entities/Voorkeur.php

class Voorkeur
{
    private static $idMap=array();

    private $gebruikerId;
    private $voornaam;
    private $naam;
    private $oogkleur;             //geen oogkleurId maar een oogkleur-object
    private $voorkeurGeboortedatum;
    private $voorkeurLengte;
    private $voorkeurRoker;
    private $haarkleur;             //geen Id maar object
    private $etnischeAchtergrond; //geen Id maar object
    private $opleidingsNiveau;      //geen Id maar object
    private $voorkeurGeslacht;
    private $voorkeurKinderen;
    private $voorkeurPersoonlijkheidsType;

    //private constructor Voorkeur-object
    private function __construct($gebruikerId, $voornaam, $naam, $oogkleur, $voorkeurGeboortedatum, $voorkeurLengte, $voorkeurRoker, $haarkleur, $etnischeAchtergrond, $opleidingsNiveau, $voorkeurGeslacht, $voorkeurKinderen, $voorkeurPersoonlijkheidsType)
    {
        $this->gebruikerId = $gebruikerId;
        $this->voornaam = $voornaam;
        $this->naam = $naam;
        $this->oogkleur = $oogkleur;
        $this->voorkeurGeboortedatum = $voorkeurGeboortedatum;
        $this->voorkeurLengte = $voorkeurLengte;
        $this->voorkeurRoker = $voorkeurRoker;
        $this->haarkleur = $haarkleur;
        $this->etnischeAchtergrond = $etnischeAchtergrond;
        $this->opleidingsNiveau = $opleidingsNiveau;
        $this->voorkeurGeslacht = $voorkeurGeslacht;
        $this->voorkeurKinderen = $voorkeurKinderen;
        $this->voorkeurPersoonlijkheidsType = $voorkeurPersoonlijkheidsType;
    }
    public static function create($gebruikerId, $voornaam, $naam, $oogkleur, $voorkeurGeboortedatum, $voorkeurLengte, $voorkeurRoker,
                           $haarkleur, $etnischeAchtergrond, $opleidingsNiveau, $voorkeurGeslacht, $voorkeurKinderen, $voorkeurPersoonlijkheidsType)
    {
    if(!isset(self::$idMap[$gebruikerId])){
            self::$idMap[$gebruikerId]=new Voorkeur($gebruikerId, $voornaam, $naam, $oogkleur, $voorkeurGeboortedatum, $voorkeurLengte, $voorkeurRoker,
                $haarkleur, $etnischeAchtergrond, $opleidingsNiveau, $voorkeurGeslacht, $voorkeurKinderen, $voorkeurPersoonlijkheidsType);
    }
    return self::$idMap[$gebruikerId];
    }

    //GETTERS
    public function getGebruikerId(){return $this->gebruikerId;}
    public function getVoornaam(){return $this->voornaam;}
    public function getNaam(){return $this->naam;}
    public function getOogkleur(){return $this->oogkleur;}  //object
    public function getVoorkeurGeboortedatum(){return $this->voorkeurGeboortedatum;}
    public function getVoorkeurLengte(){return $this->voorkeurLengte;}
    public function getVoorkeurRoker(){return $this->voorkeurRoker;}
    public function getHaarkleur(){return $this->haarkleur;}    //object
    public function getEtnischeAchtergrond(){return $this->etnischeAchtergrond;}    //object
    public function getOpleidingsNiveau(){return $this->opleidingsNiveau;}  //object
    public function getVoorkeurGeslacht(){return $this->voorkeurGeslacht;}
    public function getVoorkeurKinderen(){return $this->voorkeurKinderen;}
    public function getVoorkeurPersoonlijkheidsType(){return $this->voorkeurPersoonlijkheidsType;}

    //SETTERS
    public function setVoornaam($voornaam){$this->voornaam = $voornaam;}
    public function setNaam($naam){$this->naam = $naam;}
    public function setOogkleur($oogkleur){$this->oogkleur = $oogkleur;}
    public function Geboortedatum($voorkeurGeboortedatum){$this->voorkeurGeboortedatum = $voorkeurGeboortedatum;}
    public function setVoorkeurLengte($voorkeurLengte){$this->voorkeurLengte = $voorkeurLengte;}
    public function setVoorkeurRoker($voorkeurRoker){$this->voorkeurRoker = $voorkeurRoker;}
    public function setHaarkleur($haarkleur){$this->haarkleur = $haarkleur;}
    public function setEtnischeAchtergrond($etnischeAchtergrond){$this->etnischeAchtergrond = $etnischeAchtergrond;}
    public function setOpleidingsNiveau($opleidingsNiveau){$this->opleidingsNiveau = $opleidingsNiveau;}
    public function setVoorkeurGeslacht($voorkeurGeslacht){$this->voorkeurGeslacht = $voorkeurGeslacht;}
    public function setVoorkeurKinderen($voorkeurKinderen){$this->voorkeurKinderen = $voorkeurKinderen;}
    public function setVoorkeurPersoonlijkheidsType($voorkeurPersoonlijkheidsType){$this->voorkeurPersoonlijkheidsType = $voorkeurPersoonlijkheidsType;}




}