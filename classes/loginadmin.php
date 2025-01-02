<?php
namespace App;
// include_once('../config/database.php');
require "../vendor/autoload.php";
use App\config\Database;
use PDO;
$conn = Database::connect();

// ajout du premier admin
// $username = 'admin';
// $password = password_hash('admin123', PASSWORD_DEFAULT);
// $role = 'admin';
// $email = 'admin@gmail.com';

// $sql = "INSERT INTO users (username, password_hash, role, email) VALUES (:username, :password_hash, :role, :email)";
// $stmt = $conn->prepare($sql);

// // binding parameters
// $stmt->execute([
//     'username' => $username, 
//     'password_hash' => $password, 
//     'role' => $role, 
//     'email' => $email
// ]);

// echo "Utilisateur ajouté avec succès !";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pswd']; 

    echo $_POST['email'];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password_hash'])) {
            // Vérifier si l'utilisateur est un admin
            if ($user['role'] == 'admin') {
                // Si c'est un administrateur, connecter l'utilisateur
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role'] = $user['role']; // Vous pouvez ajouter d'autres informations si nécessaire

                header("Location: ../public/index.php"); 
                exit();
            } else {
                echo "Vous n'avez pas les droits d'accès administrateur.";
            }
        } else {
            header("Location: ../pages/login.php?error=true");
        }
    } else {
        header("Location: ../pages/login.php?error=true");
    }
}



?>