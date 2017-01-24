<?php
session_start();

session_destroy();

if (isset($_COOKIE['email'])) {
    unset($_COOKIE['email']);
    setcookie('email', null, -1, '/');
  };

 header('Location: ' . $_SERVER['HTTP_REFERER']);

?>