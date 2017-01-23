<?php

require_once 'services/GebruikerService.php';

require_once 'library/vendor/twig/autoloader.php';
Twig_Autoloader::register();

//vertel Twig in welke map de templates zitten
$loader = new Twig_Loader_Filesystem('presentation');
//laad nieuwe Twig Environment vanuit die map
$twig = new Twig_Environment($loader);


// toonAlleUsers
$gebruikerSvc = new GebruikerService();
$gebruikers=$gebruikerSvc->toonAlleUsers();
$aTwig["gebruikers"]=$gebruikers;
$aTwig["titel"]="vrijgezellen";


$view = $twig->render('baseextend.twig',$aTwig);

    

//toon de pagina
print($view);
