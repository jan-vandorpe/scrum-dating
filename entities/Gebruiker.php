<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 5/01/2017
 * Time: 10:26
 */
//entities/Gebruiker.php


/**
 * Class Gebruiker
 */
class Gebruiker {

 private static $idMap=array();

 //alle attributen van de tabel Gebruiker
 private $gebruikerId;
 private $email;
 private $geslacht;
 private $wachtwoord;
 private $geboorteDatum;
 private $naam;
 private $voornaam;
 private $postcode;
 private $stad;
 private $lengte;
 private $lichaamsbouwId;
 private $hOplNiveauId;
 private $beroep;
 private $etnischeAchtergrondId;
 private $roker;
 private $oogkleurId;
 private $aantalKinderen;
 private $haarkleurId;
 private $foto;
 private $persoonlijkheidsType;
 private $voorkeurGeboorteDatum;
 private $voorkeurLengte;
 private $voorkeurLichaamsbouw;
 private $voorkeurOpleidingsNiveau;
 private $voorkeurRoker;
 private $voorkeurKinderen;
 private $voorkeurPersoonlijkheidsType;
 private $voorkeurGeslacht;

    /**
     * Gebruiker constructor.
     * de constructor function is private zodat er van buiten de klasse Gebruiker
     * geen nieuw Gebruiker-object meer aangemaakt kan worden
     */
    public function __construct($gebruikerId,$email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode,
                                $stad, $lengte, $lichaamsbouwId, $hOplNiveauId, $beroep, $etnischeAchtergrondId, $roker,
                                $oogkleurId, $aantalKinderen, $haarkleurId, $foto, $persoonlijkheidsType,
                                $voorkeurGeboorteDatum, $voorkeurLengte, $voorkeurLichaamsbouw, $voorkeurOpleidingsNiveau,
                                $voorkeurRoker, $voorkeurKinderen, $voorkeurPersoonlijkheidsType, $voorkeurGeslacht)
    {
        $this->gebruikerId=$gebruikerId;
        $this->email = $email;
        $this->geslacht = $geslacht;
        $this->wachtwoord = $wachtwoord;
        $this->geboorteDatum = $geboorteDatum;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->postcode = $postcode;
        $this->stad = $stad;
        $this->lengte = $lengte;
        $this->lichaamsbouwId = $lichaamsbouwId;
        $this->hOplNiveauId = $hOplNiveauId;
        $this->beroep = $beroep;
        $this->etnischeAchtergrondId = $etnischeAchtergrondId;
        $this->roker = $roker;
        $this->oogkleurId = $oogkleurId;
        $this->aantalKinderen = $aantalKinderen;
        $this->haarkleurId = $haarkleurId;
        $this->foto = $foto;
        $this->persoonlijkheidsType = $persoonlijkheidsType;
        $this->voorkeurGeboorteDatum = $voorkeurGeboorteDatum;
        $this->voorkeurLengte = $voorkeurLengte;
        $this->voorkeurLichaamsbouw = $voorkeurLichaamsbouw;
        $this->voorkeurOpleidingsNiveau = $voorkeurOpleidingsNiveau;
        $this->voorkeurRoker = $voorkeurRoker;
        $this->voorkeurKinderen = $voorkeurKinderen;
        $this->voorkeurPersoonlijkheidsType = $voorkeurPersoonlijkheidsType;
        $this->voorkeurGeslacht = $voorkeurGeslacht;
    }

     //de aanmaak van een nieuw Gebruikerobject gebeurt door de create functie
    //die eerst controleert of er nog geen Gebruiker-object met dit id bestaat

    public static function create($gebruikerId, $email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode,
                                $stad, $lengte, $lichaamsbouwId, $hOplNiveauId, $beroep, $etnischeAchtergrondId, $roker,
                                $oogkleurId, $aantalKinderen, $haarkleurId, $foto, $persoonlijkheidsType,
                                $voorkeurGeboorteDatum, $voorkeurLengte, $voorkeurLichaamsbouw, $voorkeurOpleidingsNiveau,
                                $voorkeurRoker, $voorkeurKinderen, $voorkeurPersoonlijkheidsType, $voorkeurGeslacht){

       //bestaat er al een object Gebruiker met deze GebruikersId
        if(!isset(self::$idMap[$gebruikerId])) {
            //indien NEE
            self::$idMap[$gebruikerId] = new Gebruiker($gebruikerId, $email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode,
                $stad, $lengte, $lichaamsbouwId, $hOplNiveauId, $beroep, $etnischeAchtergrondId, $roker,
                $oogkleurId, $aantalKinderen, $haarkleurId, $foto, $persoonlijkheidsType,
                $voorkeurGeboorteDatum, $voorkeurLengte, $voorkeurLichaamsbouw, $voorkeurOpleidingsNiveau,
                $voorkeurRoker, $voorkeurKinderen, $voorkeurPersoonlijkheidsType, $voorkeurGeslacht);
            }
            //indien JA
        return self::$idMap[$gebruikerId];
    }


    public static function getIdMap(){return self::$idMap;}

    //GETTERS
    public function getGebruikerId(){return $this->gebruikerId;}
    public function getEmail(){return $this->email;}
    public function getGeslacht(){return $this->geslacht;}
    public function getWachtwoord(){return$this->wachtwoord;}
    public function getGeboorteDatum(){return $this->geboorteDatum;}
    public function getNaam(){return $this->naam;}
    public function getVoornaam(){return $this->voornaam;}
    public function getPostcode(){return $this->postcode;}
    public function getStad(){return $this->stad;}
    public function getLengte(){return $this->lengte;}
    public function getLichaamsbouwId(){return $this->lichaamsbouwId;}
    public function getHOplNiveauId(){return $this->hOplNiveauId;}
    public function getBeroep(){return $this->beroep;}
    public function getEtnischeAchtergrondId(){return $this->etnischeAchtergrondId;}
    public function getRoker(){return $this->roker;}
    public function getOogkleurId(){return $this->oogkleurId;}
    public function getAantalKinderen(){return $this->aantalKinderen;}
    public function getHaarkleurId(){return $this->haarkleurId;}
    public function getFoto(){return $this->foto;}
    public function getPersoonlijkheidsType(){return $this->persoonlijkheidsType;}
    public function getVoorkeurGeboorteDatum(){return $this->voorkeurGeboorteDatum;}
    public function getVoorkeurLengte(){return $this->voorkeurLengte;}
    public function getVoorkeurLichaamsbouw(){return $this->voorkeurLichaamsbouw;}
    public function getVoorkeurOpleidingsNiveau(){return $this->voorkeurOpleidingsNiveau;}
    public function getVoorkeurRoker(){return $this->voorkeurRoker;}
    public function getVoorkeurKinderen(){return $this->voorkeurKinderen;}
    public function getVoorkeurPersoonlijkheidsType(){return $this->voorkeurPersoonlijkheidsType;}
    public function getVoorkeurGeslacht(){return $this->voorkeurGeslacht;}

  //setters
    //geen setter voor gebruikersId want deze is auto_increment
    public function setEmail($email){$this->email = $email;}
    public function setWachtwoord($wachtwoord){$this->wachtwoord = $wachtwoord;}
    public function setGeslacht($geslacht){$this->geslacht= $geslacht;}
    public function setGeboorteDatum($geboorteDatum){$this->geboorteDatum = $geboorteDatum;}
    public function setNaam($naam){$this->naam = $naam;}
    public function setVoornaam($voornaam){$this->voornaam = $voornaam;}
    public function setPostcode($postcode){$this->postcode = $postcode;}
    public function setStad($stad){$this->stad = $stad;}
    public function setLengte($lengte){$this->lengte = $lengte;}
    public function setLichaamsbouwId($lichaamsbouwsId){$this->lichaamsbouwId = $lichaamsbouwsId;}
    public function setHOplNiveauId($hOplNiveauId){$this->hOplNiveauId = $hOplNiveauId;}
    public function setBeroep($beroep){$this->beroep = $beroep;}
    public function setEtnischeAchtergrondId($etnischeAchtergrondId){$this->etnischeAchtergrondId = $etnischeAchtergrondId;}
    public function setRoker($roker){$this->roker = $roker;}
    public function setOogkleurId($oogkleurId){$this->oogkleurId = $oogkleurId;}
    public function setAantalKinderen($aantalKinderen){$this->aantalKinderen = $aantalKinderen;}
    public function setHaarkleurId($haarkleurId){$this->haarkleurId = $haarkleurId;}
    public function setFoto($foto){$this->foto = $foto;}
    public function setPersoonlijkheidsType($persoonlijkheidsType){$this->persoonlijkheidsType = $persoonlijkheidsType;}
    public function setVoorkeurGeboorteDatum($voorkeurGeboorteDatum){$this->voorkeurGeboorteDatum = $voorkeurGeboorteDatum;}
    public function setVoorkeurLengte($voorkeurLengte){$this->voorkeurLengte = $voorkeurLengte;}
    public function setVoorkeurLichaamsbouw($voorkeurLichaamsbouw){$this->voorkeurLichaamsbouw = $voorkeurLichaamsbouw;}
    public function setVoorkeurOpleidingsniveau($voorkeurOpleidingsNiveau){$this->voorkeurOpleidingsNiveau = $voorkeurOpleidingsNiveau;}
    public function setVoorkeurRoker($voorkeurRoker){$this->voorkeurRoker = $voorkeurRoker;}
    public function setVoorkeurKinderen($voorkeurKinderen){$this->voorkeurKinderen = $voorkeurKinderen;}
    public function setVoorkeurPersoonlijk($voorkeurPersoonlijkheidsType){$this->voorkeurPersoonlijkheidsType = $voorkeurPersoonlijkheidsType;}
    public function setVoorkeurGeslacht($voorkeurGeslacht){$this->voorkeurGeslacht = $voorkeurGeslacht;}

}
