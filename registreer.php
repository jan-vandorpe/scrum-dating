<?php


require_once 'services/GebruikerService.php';


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $geslacht = $_POST['geslacht'];
    $wachtwoord = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $geboorteDatum = $_POST['geboorteDatum'];
    $naam = $_POST['naam'];
    $voornaam = $_POST['voornaam']; 
    $postcode= $_POST['postcode'];
    $stad= $_POST['stad'];
    $voorkeurGeslacht= $_POST['Vgeslacht'];
    
    $gebService = new GebruikerService();

    $gebService->createUser($email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode, $stad,$voorkeurGeslacht);    

    header('Location: login.php');
}
