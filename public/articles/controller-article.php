<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\config\Database;
use App\Article;
use App\ArticleTag;

$conn = Database::connect();
// ajouter des catégories
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {

    // var_dump($_POST['tags']);
    $tagss = $_POST['tags'];
    // echo($tagss[0]);

    $categorieID =  intval($_POST['category_name']) ;
    $article = new Article($_POST['article_name'], $_POST['article_slug'], $_POST['description_article'], $_POST['article_meta_description'],$categorieID);
    $id = $article->addArticle($conn);

    foreach($tagss as $tag){
        $articletag = new ArticleTag($id, $tag);
        $articletag->addArticleTag();
    };

    header('Location: list-articles.php'); 
    exit();
}




?>