<?php
session_start();

require_once 'library/vendor/Twig/Autoloader.php';
require_once 'services/GebruikerService.php';
require_once 'entities/Gebruiker.php';

Twig_AutoLoader::register();

$loader = new Twig_Loader_Filesystem('presentation');

$twig = new Twig_Environment($loader);


if (isset($_SESSION["login"])) 
{
    $login = $_SESSION["login"];
}
else 
{
    $login = false;
}

if (isset($_POST['registreren'])) 
{ 
    $email = $_POST['email'];
    $geslacht = $_POST['geslacht'];
    $wachtwoord = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $geboorteDatum = $_POST['geboorteDatum'];
    $naam = $_POST['naam'];
    $voornaam = $_POST['voornaam'];
    $postcode = $_POST['postcode'];
    $stad = $_POST['stad'];
    $voorkeurGeslacht = $_POST['Vgeslacht'];

    $gebService = new GebruikerService();
    $gebruiker = $gebService->createUser($email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode, $stad, $voorkeurGeslacht);   
    
    $_SESSION["login"] = $gebruiker;     

    $view = $twig->render('index.twig', array('email' => $email, 'login' => $login));

    header('Location: ' . $_SERVER['HTTP_REFERER']);
       
    exit(0);
}
