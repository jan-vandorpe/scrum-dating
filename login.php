<?php
require_once 'services/GebruikerService.php';

if(isset($_POST))
{
    $email = $_POST['email'];
    $gebService = new GebruikerService();
    $password = $gebService->getPassword($email);
    print $password;
}
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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        
     
        <fieldset>
            <label for='email'>email *</label>
            <input type="email" name="email" id="email" placeholder="youremail@datingsite.com" required>
            <label class="msg"></label>
            <label for='password'>password *</label>
            <input type="password" name="password" id="password" placeholder="password" required>
            <label class="msg"></label>     
        </fieldset>
      


        <input type="submit" value="login">

        </form>


</main>


</body>
</html>