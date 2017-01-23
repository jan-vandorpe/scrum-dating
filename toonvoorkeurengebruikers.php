<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 5/01/2017
 * Time: 14:56
 */
//CONTROLLER
//toonalleachtergronden.php
require_once ('services/VoorkeurService.php');



$voorkeurSvc=new VoorkeurService();
//$lijst=$voorkeurSvc->getVoorkeurenGebruikers();
$lijst2=$voorkeurSvc->getVoorkeurGebruiker(1);

print ($lijst2);
