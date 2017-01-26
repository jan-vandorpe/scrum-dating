<?php
session_start();

require_once 'services/GebruikerService.php';

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


// renderen van de pagina
    $view = $twig->render('bericht.twig',$aTwig);



//toon de pagina
    print($view);
}