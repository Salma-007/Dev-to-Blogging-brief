<?php
session_start();

require realpath(__DIR__.'/../vendor/autoload.php');
use App\config\Database;
use App\User;
$conn = Database::connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pswd']; 

    $auth = new User();
    $auth->loginUser($email, $password);

}



?>