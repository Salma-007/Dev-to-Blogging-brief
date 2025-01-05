<?php
require '../../vendor/autoload.php';
use App\User;
use App\config\Database;

$conn = Database::connect();

// add user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User($_POST['username'], $_POST['email'], $_POST['pswd'], null, 'visitor');
    $user->insertUser($conn);
    header('Location: /devblog brief/pages/login.php'); 
    exit();
}

// asign role to a visitor
if(isset($_GET['id']) && $_GET['action'] === 'role'){
    $user = new User(null,null,null,$_GET['id']);
    var_dump($user->assignRoleAuthor($conn));
    header('Location: visitors.php'); 
    exit();
}











?>