<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 23/01/2017
 * Time: 12:01
 */
//services/VoorkeurService.php
require_once ('data/VoorkeurDAO.php');

class VoorkeurService
{
    public function getVoorkeurenGebruikers(){
        $voorkeurDAO=new VoorkeurDAO();
        $lijst=$voorkeurDAO->getVoorkeurenAlleGebruikers();
        return $lijst;
    }
    public function getVoorkeurGebruiker($id){
        $voorkeurDAO=new VoorkeurDAO();
        $lijst=$voorkeurDAO->getVoorkeurenGebruiker($id);
        return $lijst;
    }
    
    public function updateVoorkeuren($id,$lengte,$opleidingsNiveau,$persoonlijkheid,$roker,$kinderen,$oogkleur,$haarkleur,$etniciteit)
    {
 
        $VoorkeurDAO = new VoorkeurDAO();
        $Voorkeur = $VoorkeurDAO->getVoorkeurenGebruiker($id);

        $Voorkeur->setLengte(setVoorkeurLengte);
        $Voorkeur->setOpleidingsNiveau($opleidingsNiveau);
        $Voorkeur->setVoorkeurPersoonlijkheidsType($persoonlijkheid);
        $Voorkeur->setVoorkeurRoker($roker);
        $Voorkeur->setVoorkeurKinderen($kinderen);
        $Voorkeur->setOogkleur($oogkleur);
        $Voorkeur->setHaarkleur($haarkleur);
        $Voorkeur->setEtnischeAchtergrond($etniciteit);
        
        $VoorkeurDAO->updateUserKenmerken($Voorkeur);              
    }
}