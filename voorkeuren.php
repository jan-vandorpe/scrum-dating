<?php

require_once 'services/GebruikerService.php';
require_once 'services/HaarkleurService.php';

require_once 'library/vendor/twig/autoloader.php';
Twig_Autoloader::register();

//vertel Twig in welke map de templates zitten
$loader = new Twig_Loader_Filesystem('presentation');
//laad nieuwe Twig Environment vanuit die map
$twig = new Twig_Environment($loader);

$haarkleurSvc=new HaarkleurService();
$haarkleurLijst=$haarkleurSvc->toonAlleHaarkleuren();

$aTwig["haarkleuren"]=$haarkleurLijst;
$aTwig["titelhaar"]="Haarkleuren";
$aTwig["titleoogkleur"]

$view = $twig->render('voorkeuren.twig',$aTwig);

    

//toon de pagina
print($view);
