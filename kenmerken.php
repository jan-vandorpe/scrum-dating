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
// haarkleur toevoegen

if (isset($_SESSION["gebruikerId"])) 
{   
    $gid= (int)$_SESSION["gebruikerId"];
    $gebruikerSvc = new GebruikerService();
    $gebruiker=$gebruikerSvc->getById($gid);
    $aTwig["gebruiker"]=$gebruiker;  





$haarkleurSvc=new HaarkleurService();
$haarkleurLijst=$haarkleurSvc->toonAlleHaarkleuren();
$aTwig["haarkleuren"]=$haarkleurLijst;

$aTwig["titelhaar"]="haarkleur";
$aTwig["titelhaarkleur"]="Haarkleur";
$aTwig["haarName"]="haarkleur";

// oogkleur toevoegen
$oogkleurSvc=new OogkleurService();
$oogkleurLijst=$oogkleurSvc->toonAlleOogkleuren();
$aTwig["oogkleuren"]=$oogkleurLijst;
$aTwig["titeloogkleur"]="Oogkleur";
$aTwig["oogName"]="oogkleur";

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
$aTwig["titeletnachtergronden"]="Etnische Achtergrond";
$aTwig["etnName"] ="etniciteit";

// opleidingsniveaus ophalen
$opleidingsNiveausSvc=new OpleidingsniveauService();
$opleidingsNiveausLijst=$opleidingsNiveausSvc->toonAlleOpleidingsniveaus();
$aTwig["opleidingsNiveaus"]=$opleidingsNiveausLijst;
$aTwig["titelopleidingsniveau"]="Opleidingsniveau";
$aTwig["opleidingName"] ="opleidingsniveau";



$view = $twig->render('kenmerken.twig',$aTwig);
//toon de pagina
print($view);

//database updaten
if (isset($_POST['updateKenmerken']))
{
   $gebruikerId = (int) $_SESSION["gebruikerId"];
   $lengte = $_POST['lengte']; 
   $opleidingsNiveau = $_POST['opleidingsniveau'];
   $persoonlijkheid = $_POST['persoonlijkheid'];
   $roker = $_POST['roker'];
   $kinderen = $_POST['aantalKinderen'];
   $oogkleur = $_POST['oogkleur'];
   $haarkleur = $_POST['haarkleur'];
   $etniciteit = $_POST['etniciteit'];
  


   $gebruikerSVC = new GebruikerService;  
   $gebruikerSVC -> updateUserKenmerken($gebruikerId,$lengte,$opleidingsNiveau,$persoonlijkheid,$roker,$kinderen,$oogkleur,$haarkleur,$etniciteit);
   exit(0);
}
}
