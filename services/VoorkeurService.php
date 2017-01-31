<?php

/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 23/01/2017
 * Time: 12:01
 */
//services/VoorkeurService.php
require_once ('data/VoorkeurDAO.php');
require_once ('entities/Voorkeur.php');

class VoorkeurService
{
    public function getVoorkeurenGebruikers(){
        $voorkeurDAO=new VoorkeurDAO();
        $lijst=$voorkeurDAO->getVoorkeurenAlleGebruikers();
        return $lijst;
    }
    public function getVoorkeurenGebruiker($id){
        $voorkeurDAO=new VoorkeurDAO();
        $lijst=$voorkeurDAO->getVoorkeurenGebruiker($id);
        return $lijst; //RETURN OBJECT
    }

    
    public function updateVoorkeuren($id,$lengte,$opleidingsNiveau,$persoonlijkheid,$roker,$kinderen,$voorkeurOogkleuren,$voorkeurHaarkleuren,$voorkeurEtniciteiten)
    {
 
        $VoorkeurDAO = new VoorkeurDAO();
        $Voorkeur = $VoorkeurDAO->getVoorkeurenGebruiker($id);

        $Voorkeur->setVoorkeurLengte($lengte);
        $Voorkeur->setOpleidingsNiveau($opleidingsNiveau);
        $Voorkeur->setVoorkeurPersoonlijkheidsType($persoonlijkheid);
        $Voorkeur->setVoorkeurRoker($roker);
        $Voorkeur->setVoorkeurKinderen($kinderen);
        $Voorkeur->setOogkleur($voorkeurOogkleuren);
        $Voorkeur->setHaarkleur($voorkeurHaarkleuren);
        $Voorkeur->setEtnischeAchtergrond($voorkeurEtniciteiten);
        
        $VoorkeurDAO->updateUserVoorkeuren($Voorkeur);              
    }

    public function getVoorkeurOogkleur($id)
    {
        $voorkeurDAO = new VoorkeurDAO();
        $lijst = $voorkeurDAO->getVoorkeurOogkleur($id);

        return $lijst;
    }

    public function getVoorkeurHaarkleur($id)
    {
        $voorkeurDAO = new VoorkeurDAO();
        $lijst = $voorkeurDAO->getVoorkeurHaarkleur($id);

        return $lijst;
    }

    public function getVoorkeurEtniciteit($id)
    {
        $voorkeurDAO = new VoorkeurDAO();
        $lijst = $voorkeurDAO->getVoorkeurEtniciteit($id);

        return $lijst;
    }

}