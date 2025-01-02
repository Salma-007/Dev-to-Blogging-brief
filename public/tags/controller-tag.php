<?php
require_once __DIR__ . '/../../vendor/autoload.php';
// use App\config\Database;
use App\Tag;

// ajouter des tag
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_tag'])) {
    $tag = new Tag($_POST['nom_tag']);
    $tag->insertTag();
    header('Location: list-tags.php'); 
    exit();
}

// delete des tags
if(isset($_GET['id']) ){
    $tag = new Tag(null,$_GET['id']);
    $tag->deleteTag();
    header('Location: list-tags.php'); 
    exit();
}

// update des tags
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_tag'])) {
    $tag = new Tag($_POST['tag_name'], $_POST['id']);
    $tag->updateTag();
    header('Location: list-tags.php'); 
    exit();
}








?>