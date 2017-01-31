<?php
session_start();

require_once 'services/GebruikerService.php';

require_once 'library/vendor/twig/autoloader.php';
Twig_Autoloader::register();

//vertel Twig in welke map de templates zitten
$loader = new Twig_Loader_Filesystem('presentation');
//laad nieuwe Twig Environment vanuit die map
$twig = new Twig_Environment($loader);

if (isset($_SESSION["gebruikerId"]))
{
    $gid= (int)$_SESSION["gebruikerId"];
    $gebruikerSvc = new GebruikerService();
    $gebruiker=$gebruikerSvc->getById($gid);
    $aTwig["gebruiker"]=$gebruiker;
    

    if(isset($_GET['id']) && is_array($_GET['id'])){
       $match = array();
       $id = $_GET['id'];
       foreach($id as $value){
           array_push($match,$gebruikerSvc->getById($value));

       }

        $aTwig["matches"] = $match;


      if(!(isset($_GET['bericht']))){
            $view = $twig->render('bericht/bericht.twig',$aTwig);
        }else{
            $view = $twig->render('bericht/verzonden.twig',$aTwig);
        }
    }
    elseif (isset($_GET['id'])){
        $id = $_GET['id'];
        $match=$gebruikerSvc->getById($id);
        $aTwig["match"] = $match;
        if(!(isset($_GET['bericht']))){
            $view = $twig->render('bericht/bericht.twig',$aTwig);
        }else{
            $view = $twig->render('bericht/verzonden.twig',$aTwig);
        }
    }
    else{
          $view = $twig->render('fout.twig',$aTwig);
    }



    
    
// renderen van de pagina
    



//toon de pagina
    print($view);
}
else
{
    $location = 'index.php';
    header('Location: ' . $location);

}