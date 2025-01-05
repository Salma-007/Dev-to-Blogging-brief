<?php
session_start();

require realpath(__DIR__.'/../vendor/autoload.php');
use App\config\Database;
// use PDO;
$conn = Database::connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pswd']; 

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password_hash'])) {

            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Rediriger en fonction du rôle
            if ($user['role'] === 'admin') {
                header('Location: /devblog brief/public/users/index.php');
                exit();
            } elseif ($user['role'] === 'auteur') {
                header('Location: /devblog brief/public/users/index.php');
                exit();
            } else {
                header('Location: articles.php');
                exit();
            }
        } else {
            header("Location: ../pages/login.php?error=true");
        }
    } else {
        header("Location: ../pages/login.php?error=true");
    }
}



?>