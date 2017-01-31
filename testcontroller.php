<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 31/01/2017
 * Time: 10:36
 */
//testcontroller.php
require_once ('services/VoorkeurService.php');
require_once ('services/GebruikerService.php');
$voorkeurSvc=new VoorkeurService();
$voorkeurGebruiker=$voorkeurSvc->getVoorkeurenGebruiker(1);
$gebruikerSvc=new GebruikerService();
$kenmerkenGebruikers=$gebruikerSvc->getUserKenmerken();
print_r($voorkeurGebruiker);
var_dump($kenmerkenGebruikers);

$lengteVoorkeuren=count($voorkeurGebruiker);

foreach ($kenmerkenGebruikers as $kenmerk){
    $teller=0;
   for ($i=0;$i<count($voorkeurGebruiker);$i++){
       $gebruikerId=$kenmerk[$i];
       if ($kenmerk==$voorkeurGebruiker[$i]){
           $teller+=1;
       }

   }
}