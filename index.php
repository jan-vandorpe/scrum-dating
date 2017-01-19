<?php
session_start();

//index.php

require_once 'services/GebruikerService.php';
//Verwijst naar de twig library
require_once 'library/vendor/Twig/Autoloader.php';
Twig_Autoloader::register();

//vertel Twig in welke map onze templates zitten
$loader = new Twig_Loader_Filesystem('presentation');

//laad nieuwe Twig Environment vanuit die map
$twig = new Twig_Environment($loader); 


if (isset($_SESSION["gebruikerId"])) 
    {   
    $gid= (int)$_SESSION["gebruikerId"];
    $gebruikerSvc = new GebruikerService();
    $gebruiker=$gebruikerSvc->getById($gid);
    $aTwig["gebruiker"]=$gebruiker;

    $view = $twig->render('index.twig', $aTwig);
    
  
}
else
{
    $login = false;
    $view = $twig->render('index.twig');
}
//toon de pagina
print($view);
