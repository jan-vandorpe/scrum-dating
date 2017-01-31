<?php
session_start();
if (isset($_SESSION["gebruikerId"])) 
{  
require_once 'services/GebruikerService.php';
// services opvulling lijsten
require_once 'services/HaarkleurService.php';
require_once 'services/OogkleurService.php';
require_once 'services/LichaamstypeService.php';
require_once 'services/etnAchtergrondService.php';
require_once 'services/OpleidingsniveauService.php';
require_once 'library/vendor/twig/autoloader.php';
Twig_Autoloader::register();
//vertel Twig in welke map de templates zitten
$loader = new Twig_Loader_Filesystem('presentation');
//laad nieuwe Twig Environment vanuit die map
$twig = new Twig_Environment($loader);
// haarkleur toevoegen

if (isset($_SESSION["gebruikerId"])) 
{   
    $gid= (int)$_SESSION["gebruikerId"];
    $gebruikerSvc = new GebruikerService();
    $gebruiker=$gebruikerSvc->getById($gid);
    $aTwig["gebruiker"]=$gebruiker;  

//database updaten
if (isset($_POST['updateKenmerken']))
{
   $gebruikerId = (int) $_SESSION["gebruikerId"];
   $lengte = $_POST['lengte']; 
   $opleidingsNiveau = $_POST['opleidingsniveau'];
   $persoonlijkheid = $_POST['persoonlijkheid'];
   $roker = $_POST['roker'];
   $kinderen = $_POST['aantalKinderen'];
   $oogkleur = $_POST['oogkleur'];
   $haarkleur = $_POST['haarkleur'];
   $etniciteit = $_POST['etniciteit'];
  


   $gebruikerSVC = new GebruikerService;  
   $gebruikerSVC -> updateUserKenmerken($gebruikerId,$lengte,$opleidingsNiveau,$persoonlijkheid,$roker,$kinderen,$oogkleur,$haarkleur,$etniciteit);   
   echo("<meta http-equiv='refresh' content='1'>");
}

// Check if image file is a actual image or fake image
    if(isset($_POST["fotoUpload"])) {
        $target_dir = "images/profiel/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
          //  echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
          //  echo "File is not an image.";
            $uploadOk = 0;
        }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 5242880) {
      //  echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
      //  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      //  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
           // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $gebruikerId = (int) $_SESSION["gebruikerId"];
           // echo basename($_FILES["fileToUpload"]["name"]);
            $foto = basename($_FILES["fileToUpload"]["name"]);
            $gebruikerSVC = new GebruikerService;
            $gebruikerSVC -> updateUserFoto($gebruikerId,$foto);
           // echo("<meta http-equiv='refresh' content='1'>");
        } else {
      //     echo "Sorry, there was an error uploading your file.";
        }
    }
    }




$haarkleurSvc=new HaarkleurService();
$haarkleurLijst=$haarkleurSvc->toonAlleHaarkleuren();
$aTwig["haarkleuren"]=$haarkleurLijst;

$aTwig["titelhaar"]="haarkleur";
$aTwig["titelhaarkleur"]="Haarkleur";
$aTwig["haarName"]="haarkleur";


// oogkleur toevoegen
$oogkleurSvc=new OogkleurService();
$oogkleurLijst=$oogkleurSvc->toonAlleOogkleuren();
$aTwig["oogkleuren"]=$oogkleurLijst;
$aTwig["titeloogkleur"]="Oogkleur";
$aTwig["oogName"]="oogkleur";

// lichaamstypes toevoegen
$lichaamsSvc=new LichaamstypeService();
$lichaamsLijst=$lichaamsSvc->toonAlleLichaamstypes();
$aTwig["lichaamstypes"]=$lichaamsLijst;
$aTwig["titellichaamstypes"]="Lichaamstypes";
$aTwig["lichaamsName"] ="lichaamstype";
//etniciteiten ophalen
$etnAchtergrondSvc=new etnAchtergrondService();
$etnAchtergrondLijst=$etnAchtergrondSvc->toonAlleAchtergronden();
$aTwig["etnAchtergronden"]=$etnAchtergrondLijst;
$aTwig["titeletnachtergronden"]="Etnische Achtergrond";
$aTwig["etnName"] ="etniciteit";

// opleidingsniveaus ophalen
$opleidingsNiveausSvc=new OpleidingsniveauService();
$opleidingsNiveausLijst=$opleidingsNiveausSvc->toonAlleOpleidingsniveaus();
$aTwig["opleidingsNiveaus"]=$opleidingsNiveausLijst;
$aTwig["titelopleidingsniveau"]="Opleidingsniveau";
$aTwig["opleidingName"] ="opleidingsniveau";



$view = $twig->render('kenmerken.twig',$aTwig);
//toon de pagina
 print($view);



   
}


}
else 
    {
     $location = 'index.php';
    header('Location: ' . $location);

}
