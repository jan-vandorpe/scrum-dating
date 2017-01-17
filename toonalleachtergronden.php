<?php
/**
 * Created by PhpStorm.
 * User: cyber10
 * Date: 5/01/2017
 * Time: 14:56
 */
//CONTROLLER
//toonalleachtergronden.php
require_once ("services/etnAchtergrondService.php");
require_once ("library/vendor/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader=new Twig_Loader_Filesystem('Testfiles/presentation');
$twig=new Twig_Environment($loader);

$achtergrondSvc=new etnAchtergrondService();
$achtergrondLijst=$achtergrondSvc->toonAlleAchtergronden();
$aTwig["achtergronden"]=$achtergrondLijst;
$aTwig["titel"]="overzicht etnische achtergronden";
$view=$twig->render("achtergrondenlijst.twig",$aTwig);

print ($view);
