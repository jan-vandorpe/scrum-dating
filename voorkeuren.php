<?php

require_once 'services/GebruikerService.php';

// services opvulling lijsten
require_once 'services/HaarkleurService.php';
require_once 'services/OogkleurService.php';
require_once 'services/LichaamstypeService.php';
require_once 'services/etnAchtergrondService.php';
require_once 'services/OpleidingsniveauService.php';

require_once 'library/vendor/twig/autoloader.php';
Twig_Autoloader::register();

//vertel Twig in welke map de templates zitten
$loader = new Twig_Loader_Filesystem('presentation');
//laad nieuwe Twig Environment vanuit die map
$twig = new Twig_Environment($loader);


// haarkleur toevoegen
$haarkleurSvc=new HaarkleurService();
$haarkleurLijst=$haarkleurSvc->toonAlleHaarkleuren();

$aTwig["haarkleuren"]=$haarkleurLijst;
$aTwig["titelhaar"]="Haarkleuren";


// oogkleur toevoegen
$oogkleurSvc=new OogkleurService();
$oogkleurLijst=$oogkleurSvc->toonAlleOogkleuren();

$aTwig["oogkleuren"]=$oogkleurLijst;
$aTwig["titeloogkleur"]="Oogkleuren";

// lichaamstypes toevoegen
$lichaamsSvc=new OogkleurService();
$lichaamsLijst=$lichaamsSvc->toonAlleOogkleuren();

$aTwig["lichaamstypes"]=$lichaamsLijst;
$aTwig["titellichaamstypes"]="Lichaamstypes";


//etniciteiten ophalen
$etnAchtergrondSvc=new etnAchtergrondService();
$etnAchtergrondLijst=$etnAchtergrondSvc->toonAlleAchtergronden();

$aTwig["etnAchtergronden"]=$etnAchtergrondLijst;
$aTwig["titeletnachtergronden"]="Etnische Achtergrond";

// opleidingsniveaus ophalen
$opleidingsNiveausSvc=new OpleidingsniveauService();
$opleindingsNiveausLijst=$opleidingsNiveausSvc->toonAlleOpleidingsNiveaus();

$aTwig["opleidingsNiveaus"]=$opleindingsNiveausLijst;
$aTwig["titelopleidingsniveau"]="Opleidingsniveaus";



$view = $twig->render('voorkeuren.twig',$aTwig);

    

//toon de pagina
print($view);
