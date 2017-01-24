<?php
session_start();

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


if (isset($_SESSION["gebruikerId"])) 
{   
    $gid= (int)$_SESSION["gebruikerId"];
    $gebruikerSvc = new GebruikerService();
    $gebruiker=$gebruikerSvc->getById($gid);
    $aTwig["gebruiker"]=$gebruiker;  
    
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
$lichaamsSvc=new LichaamstypeService();
$lichaamsLijst=$lichaamsSvc->toonAlleLichaamstypes();

$aTwig["lichaamstypes"]=$lichaamsLijst;
$aTwig["titellichaamstypes"]="Lichaamstypes";
$aTwig["lichaamsName"] ="lichaamstype";


//etniciteiten ophalen
$etnAchtergrondSvc=new etnAchtergrondService();
$etnAchtergrondLijst=$etnAchtergrondSvc->toonAlleAchtergronden();

$aTwig["etnAchtergronden"]=$etnAchtergrondLijst;
$aTwig["titeletnachtergronden"]="Etnische Achtergronden";
$aTwig["etnName"] ="Etniciteit";

// opleidingsniveaus ophalen
$opleidingsNiveausSvc=new OpleidingsniveauService();
$opleidingsNiveausLijst=$opleidingsNiveausSvc->toonAlleOpleidingsniveaus();

$aTwig["opleidingsNiveaus"]=$opleidingsNiveausLijst;
$aTwig["titelopleidingsniveau"]="Opleidingsniveaus";
$aTwig["opleidingName"] ="opleidingsniveau";



$view = $twig->render('gebruikerinstellingen.twig',$aTwig);



//toon de pagina
print($view);
}