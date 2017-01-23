<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 19/01/2017
 * Time: 9:27
 */
//toonallevoorkeurengebruiker.php

require_once ("services/GebruikerService.php");
require_once ("library/vendor/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader=new Twig_Loader_Filesystem('presentation');
$twig=new Twig_Environment($loader);

$gebruikerSvc=new GebruikerService();
$gebruiker=$gebruikerSvc->toonGebruiker(1);
$aTwig["gebruiker"]=$gebruiker;
$aTwig["titel"]="Gebruiker:";
$view=$twig->render("gebruiker.twig",$aTwig);

print ($view);
