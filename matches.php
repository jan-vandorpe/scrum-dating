<?php
session_start();

require_once 'services/GebruikerService.php';

require_once 'library/vendor/twig/autoloader.php';
Twig_Autoloader::register();

//vertel Twig in welke map de templates zitten
$loader = new Twig_Loader_Filesystem('presentation');
//laad nieuwe Twig Environment vanuit die map
$twig = new Twig_Environment($loader);

if (isset($_SESSION["gebruikerId"])) {
    $gid = (int)$_SESSION["gebruikerId"];
    $gebruikerSvc = new GebruikerService();
    $gebruiker = $gebruikerSvc->getById($gid);
    $aTwig["gebruiker"] = $gebruiker;
// aanmaken service user voor ze op te halen
//constructor van een nieuwe service
    $gebruikerSvc = new GebruikerService();
//Ophalen gebruikers 
    $matches = $gebruikerSvc->toonAlleUsers();
//In een twig array de variabelen meegeven die worden doorgeven aan twig
    $aTwig["matches"] = $matches;
    $aTwig["titel"] = "Matches";

// renderen van de pagina
    $view = $twig->render('match/matches.twig', $aTwig);


//toon de pagina
    print($view);

}