<?php

require_once 'library/vendor/Twig/Autoloader.php';
require_once 'services/GebruikerService.php';
 
Twig_Autoloader::register();
//initialize twig environment
$loader = new Twig_Loader_Filesystem('presentation');
$twig = new Twig_Environment($loader);

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["login"])) 
{
    $login = $_SESSION["login"];
}
else {
    $login = false;
}


if (isset($_POST['login'])) 
{
    
    $email = $_POST['email'];
    unset($_COOKIE["email"]);
    setcookie("email", $email, time() + 31556926, '/');
    $_COOKIE["email"] = $email;
    
    $wachtwoord = password_hash($_POST['$wachtwoord'], PASSWORD_DEFAULT);

    $gebSvc = new GebruikerService();
    $loginCheck = $gebSvc->checkLogin($email, $password);

    if ($loginCheck == false) 
    {
        $view = $twig->render('index2.twig');
        print($view);
        print 'kak';
        exit(0);
    }
    else {
        $_SESSION["login"] = $loginCheck;
        $login = $loginCheck;
        print 'fack';

        $view = $twig->render('index2.twig', array('login' => $login));
        print($view);
        exit(0);
    }
}
