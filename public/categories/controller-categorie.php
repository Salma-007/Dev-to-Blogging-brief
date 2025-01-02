<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\config\Database;
use App\Categorie;

$conn = Database::connect();

// ajouter des catégories
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $category = new Categorie($_POST['category_name'], $_POST['description']);
    $category->addCategory($conn);
    header('Location: list-categories.php'); 
    exit();
}

// delete des categories
if(isset($_GET['id']) && $_GET['action'] === 'delete'){
    $category = new Categorie(null,null,$_GET['id']);
    $category->deleteCategory($conn);
    header('Location: list-categories.php'); 
    exit();
}

// update des categories
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_category'])) {
    $category = new Categorie($_POST['category_name'], $_POST['description'],$_POST['id']);
    $category->updateCategory($conn);
    header('Location: list-categories.php'); 
    exit();
}









?>