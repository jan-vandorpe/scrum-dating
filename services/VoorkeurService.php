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
}