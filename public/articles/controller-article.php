<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\config\Database;
use App\Article;
use App\ArticleTag;

$conn = Database::connect();
// ajouter des articles
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {

    // var_dump($_POST['tags']);
    $tagss = $_POST['tags'];
    // echo($tagss[0]);
    $categorieID =  intval($_POST['category_name']) ;
    $article = new Article($_POST['article_name'], null, $_POST['description_article'], $_POST['article_meta_description'],$categorieID);
    $article->create_slug($_POST['article_name']);
    // var_dump($sll);
    $id = $article->addArticle($conn);

    foreach($tagss as $tag){
        $articletag = new ArticleTag($id, $tag);
        $articletag->addArticleTag();
    };
    header('Location: list-articles.php'); 
    exit();
}

// suppression d'un article
if(isset($_GET['id']) && $_GET['action'] === 'delete'){
    $article = new Article(null,null,null,null,null,null,$_GET['id']);
    $article->deletearticle($conn);
    header('Location: list-articles.php'); 
    exit();
}

// update article
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_article'])) {
    $tagss = $_POST['tags'];
    $categorieID =  intval($_POST['category_name']) ;
    $article = new Article($_POST['article_name'], null, $_POST['description_article'], $_POST['article_meta_description'],$categorieID, null ,$_POST['id']);
    $article->create_slug($_POST['article_name']);
    $article->updateArticle($conn);
    $id = $article->getId();

    $exist_tags = new ArticleTag($id);
    $exist_tags->deleteTagsbyArticle($conn);
    // $existtag = $exist_tags->getTagsbyArticle($conn);
    foreach($tagss as $tag){
        $articletag = new ArticleTag($id, $tag);
        $articletag->addArticleTag();
    };


    header('Location: list-articles.php'); 
    exit();
}

// accept article
if(isset($_GET['id']) && $_GET['action'] === 'accept'){
    $article = new Article(null,null,null,null,null,null,$_GET['id']);
    $article->acceptArticle($conn);
    header('Location: list-articles.php'); 
    exit();
}

// refuse article
if(isset($_GET['id']) && $_GET['action'] === 'refuse'){
    $article = new Article(null,null,null,null,null,null,$_GET['id']);
    $article->refuseArticle($conn);
    header('Location: list-articles.php'); 
    exit();
}




?>