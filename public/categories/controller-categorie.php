<?php
require_once __DIR__ . '/../../vendor/autoload.php';
include_once '../config/database.php';
$conn = Database::connect();

// Gestion des catégories
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $category = new Categorie(null, $_POST['category_name']);
    $category->addCategory($conn);
    header('Location: list-categorie.php'); 
    exit();
}








?>