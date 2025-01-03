<?php
require '../../vendor/autoload.php';
use App\User;


// add user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User($_POST['username'], $_POST['email'], $_POST['pswd'], null, 'auteur');
    $user->insertUser($conn);
    header('Location: /devblog brief/pages/login.php'); 
    exit();
}












?>