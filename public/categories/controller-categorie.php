<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\config\Database;
use App\Categorie;


$conn = Database::connect();

// Gestion des catégories
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $category = new Categorie($_POST['category_name'], $_POST['description']);
    $category->addCategory($conn);
    header('Location: list-categories.php'); 
    exit();
}








?>