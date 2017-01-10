<?php


require_once 'services/GebruikerService.php';


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $geslacht = $_POST['geslacht'];
    $wachtwoord = $_POST['password'];
    $geboorteDatum = $_POST['geboorteDatum'];
    $naam = $_POST['naam'];
    $voornaam = $_POST['voornaam']; 
    $postcode= $_POST['postcode'];
    $stad= $_POST['stad'];
    $voorkeurGeslacht= $_POST['Vgeslacht'];

    $lengte= '';
    $lichaamsbouwId= '';
    $hOplNiveauId= '';
    $beroep= '';
    $etnischeAchtergrondId= '';
    $roker='';
    $oogkleurId= '';
    $aantalKinderen= '';
    $haarkleurId = '';
    $foto= '';
    $persoonlijkheidsType= '';
    $voorkeurGeboorteDatum= '';
    $voorkeurLengte= '';
    $voorkeurLichaamsbouw= '';
    $voorkeurOpleidingsNiveau= '';
    $voorkeurRoker='';
    $voorkeurKinderen= '';
    $voorkeurPersoonlijkheidsType= '';
    
    $gebService = new GebruikerService();

    $gebService->createUser($email, $geslacht, $wachtwoord, $geboorteDatum, $naam, $voornaam, $postcode, $stad, $lengte, $lichaamsbouwId, $hOplNiveauId, $beroep, $etnischeAchtergrondId, $roker, $oogkleurId, $aantalKinderen, $haarkleurId, $foto, $persoonlijkheidsType, $voorkeurGeboorteDatum, $voorkeurLengte, $voorkeurLichaamsbouw, $voorkeurOpleidingsNiveau, $voorkeurRoker, $voorkeurKinderen, $voorkeurPersoonlijkheidsType, $voorkeurGeslacht);
    
    foreach ($_POST as $key => $value)
    {
        print $key . ' '. $value . '<br>';
    };

    print 'succesvol geregistreerd';
}
