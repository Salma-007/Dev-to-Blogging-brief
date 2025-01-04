<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\config\Database;
use App\Article;

$conn = Database::connect();
// ajouter des catégories
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {
    $categorieID =  intval($_POST['category_name']) ;
var_dump($categorieID);

    $article = new Article($_POST['article_name'], $_POST['article_slug'], $_POST['description_article'], $_POST['article_meta_description'],$categorieID);
    $article->addArticle($conn);
    // header('Location: list-articles.php'); 
    exit();
}




?>