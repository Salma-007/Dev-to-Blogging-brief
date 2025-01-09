<?php
session_start();
require '../../vendor/autoload.php';
use App\User;
use App\config\Database;

$conn = Database::connect();

// add user
if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['register_user'])) {
    // $user = new User($_POST['username'], $_POST['email'], $_POST['pswd'], null, 'visitor');
    $user = new User();
    $queryy = $user->registerVisitor($_POST['username'],$_POST['email'],$_POST['pswd'],$conn);
    if(!empty($queryy)){
        header('Location: /devblog brief/pages/login.php'); 
    }
    else{
        header('Location: /devblog brief/pages/login.php'); 
    }
    
    exit();
}

// asign role to a visitor
if(isset($_GET['id']) && $_GET['action'] === 'role'){
    $user = new User(null,null,null,$_GET['id']);
    $user->assignRoleAuthor($conn);
    header('Location: visitors.php'); 
    exit();
}

// ban users
if(isset($_GET['id']) && $_GET['action'] === 'ban'){
    $user = new User(null,null,null,$_GET['id']);
    $user->banUser();
    header('Location: visitors.php'); 
    exit();
}

// update user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $user = new User($_POST['username'], $_POST['email'],null,$_POST['id']);
    $user->updateUser($conn);
    if($_SESSION['role'] == 'admin'){
        header('Location: authors.php'); 
    }
    else if($_SESSION['role'] == 'auteur'){
        header('Location: /devblog brief/public/users/index.php'); 
    }
    exit();
}










?>