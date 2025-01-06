<?php
session_start();
require_once __DIR__ . '/../../vendor/autoload.php';
use App\config\Database;
use App\Article;
use App\ArticleTag;

$conn = Database::connect();
// ajouter des articles
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {

    $photo = $_FILES['photo_input']['name'];
    $photo_tmp = $_FILES['photo_input']['tmp_name'];
    $photo_folder = 'uploads/' . $photo; 
    move_uploaded_file($photo_tmp, $photo_folder);

    // var_dump($_POST['tags']);
    $tagss = $_POST['tags'];
    // echo($tagss[0]);
    $categorieID =  intval($_POST['category_name']) ;
    $article = new Article($_POST['article_name'], null, $_POST['description_article'], $_POST['article_meta_description'],$categorieID);
    $article->setAuteurID($_SESSION['id']);
    $article->setImage($photo);
    
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

// increment views
if(isset($_GET['id']) && $_GET['action'] === 'voir'){
    $article = new Article(null,null,null,null,null,null,$_GET['id']);
    $article->incrementViews($_GET['id']);
    header('Location:/devblog brief/pages/all_articles.php'); 
    exit();
}

// suppression d'un article
if(isset($_GET['id']) && $_GET['action'] === 'deleteAdmin'){
    $article = new Article(null,null,null,null,null,null,$_GET['id']);
    $article->deletearticle($conn);
    header('Location: /devblog brief/public/users/index.php'); 
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