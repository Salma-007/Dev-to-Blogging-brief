<?php
require_once __DIR__ . '/../../vendor/autoload.php';
// use App\config\Database;
use App\Tag;

// ajouter des catégories
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_tag'])) {
    $tag = new Tag($_POST['nom_tag']);
    $tag->insertTag();
    header('Location: list-tags.php'); 
    exit();
}






?>