<?php
session_start();

 if (isset($_SESSION["gebruikerId"])) 
{  
require_once 'services/GebruikerService.php';
require_once 'services/voorkeurService.php';

// services opvulling lijsten
require_once 'services/HaarkleurService.php';
require_once 'services/OogkleurService.php';
require_once 'services/LichaamstypeService.php';
require_once 'services/etnAchtergrondService.php';
require_once 'services/OpleidingsniveauService.php';
require_once 'services/VoorkeurService.php';

require_once 'library/vendor/twig/autoloader.php';

Twig_Autoloader::register();

//vertel Twig in welke map de templates zitten
$loader = new Twig_Loader_Filesystem('presentation');
//laad nieuwe Twig Environment vanuit die map
$twig = new Twig_Environment($loader);


$gid= (int)$_SESSION["gebruikerId"];
$gebruikerSvc = new GebruikerService();
$gebruiker=$gebruikerSvc->getById($gid);
$aTwig["gebruiker"]=$gebruiker;


// haarkleur toevoegen
$haarkleurSvc=new HaarkleurService();
$haarkleurLijst=$haarkleurSvc->toonAlleHaarkleuren();

$aTwig["haarkleuren"]=$haarkleurLijst;
$aTwig["titelhaar"]="Haarkleuren";
$aTwig["haarName"]="haarkleur";

// voorkeurHaarkleur toevoegen
     $vhaarkleurSvc= new VoorkeurService();
     $vhaarkleurLijst=$vhaarkleurSvc->getVoorkeurHaarkleur($gid);
     $aTwig["vhaarkleuren"]=$vhaarkleurLijst;



// oogkleur toevoegen
$oogkleurSvc=new OogkleurService();
$oogkleurLijst=$oogkleurSvc->toonAlleOogkleuren();

$aTwig["oogkleuren"]=$oogkleurLijst;
$aTwig["titeloogkleur"]="Oogkleuren";
$aTwig["oogName"]="oogkleur";

// voorkeurOogkleur toevoegen
     $voogkleurSvc= new VoorkeurService();
     $voogkleurLijst=$voogkleurSvc->getVoorkeurOogkleur($gid);
     $aTwig["voogkleuren"]=$voogkleurLijst;

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
$aTwig["etnName"] ="etniciteit";

// voorkeurEtniciteit toevoegen
     $vetnSvc= new VoorkeurService();
     $vetnLijst=$vetnSvc->getVoorkeurEtniciteit($gid);
     $aTwig["vetn"]=$vetnLijst;


// opleidingsniveaus ophalen
$opleidingsNiveausSvc=new OpleidingsniveauService();
$opleidingsNiveausLijst=$opleidingsNiveausSvc->toonAlleOpleidingsniveaus();

$aTwig["opleidingsNiveaus"]=$opleidingsNiveausLijst;
$aTwig["titelopleidingsniveau"]="Opleidingsniveaus";
$aTwig["opleidingName"] ="opleidingsniveau";


$view = $twig->render('voorkeuren.twig',$aTwig);

    

//toon de pagina
print($view);

//database updaten
if (isset($_POST['updateVoorkeuren']))
{
    
    //print_r($_POST);
    $gebruikerId = (int) $_SESSION["gebruikerId"];
    $lengte = $_POST['lengte'];
    $opleidingsNiveau = $_POST['opleidingsniveau'];
    $persoonlijkheid = $_POST['persoonlijkheid'];
    $roker = $_POST['roker'];
    $kinderen = $_POST['kinderen'];

    $voorkeurOogkleuren = array();
    foreach ($_POST['oogkleur'] as $voorkeurOogkleur)
    {
    array_push($voorkeurOogkleuren, $voorkeurOogkleur);         
    }

    $voorkeurHaarkleuren = array();
    foreach ($_POST['haarkleur'] as $voorkeurHaarkleur)
    {
        array_push($voorkeurHaarkleuren, $voorkeurHaarkleur);         
    }

    $voorkeurEtniciteiten = array();
    foreach ($_POST['etniciteit'] as $voorkeurEtniciteit)
    {
        array_push($voorkeurEtniciteiten, $voorkeurEtniciteit);         
    }  


    $voorkeurSVC = new VoorkeurService;  
    $voorkeurSVC -> updateVoorkeuren($gebruikerId,$lengte,$opleidingsNiveau,$persoonlijkheid,$roker,$kinderen,$voorkeurOogkleuren,$voorkeurHaarkleuren,$voorkeurEtniciteiten);

}

}

else {
     $location = 'index.php';
    header('Location: ' . $location);

}