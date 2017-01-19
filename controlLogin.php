<?php
session_start();
require_once 'library/vendor/Twig/Autoloader.php';
require_once 'services/GebruikerService.php';
 
Twig_Autoloader::register();
//initialize twig environment

$loader = new Twig_Loader_Filesystem('presentation');
$twig = new Twig_Environment($loader);

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
    
    $wachtwoord = $_POST['wachtwoord'];

    $gebSvc = new GebruikerService();
    $loginCheck = $gebSvc->checkLogin($email, $wachtwoord);
    

    if ($loginCheck == false) 
    {   
        print "false";
        $view = $twig->render('login.twig');
        print($view);  
        exit(0);
       
    }
    else 
        {   
        $_SESSION['gebruikerId'] = $loginCheck;    
        header('Location: ' . $_SERVER['HTTP_REFERER']);
       
        exit(0);
    }
}
