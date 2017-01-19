<?php
require_once 'services/GebruikerService.php';

?>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Register</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="style.css">

    <!--[if lt IE 9]>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
<!-- <script src="js/scripts.js"></script> -->

<main>
 <h1>U bent succesvol geregistreerd</h1>
 <form action="controlLogin.php" method="post">
        
     
        <fieldset>
            <label for='email'>email *</label>
            <input type="email" name="email" id="email" placeholder="youremail@datingsite.com" required>
            <label class="msg"></label>
            <label for='wachtwoord'>wachtwoord *</label>
            <input type="password" name="wachtwoord" id="password" placeholder="password" required>
           
        </fieldset>
      


     <input type="submit" value="login" name="login">

        </form>


</main>


</body>
</html>