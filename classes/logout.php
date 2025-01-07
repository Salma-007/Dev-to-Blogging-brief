<?php

// session_start();
// session_unset();  
// session_destroy();  

// header('Location: /devblog brief/pages/login.php');
// exit();
require realpath(__DIR__.'/../vendor/autoload.php');
use App\User;

User::logingout();



?>