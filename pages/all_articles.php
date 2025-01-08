<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();

}
require realpath(__DIR__.'/../vendor/autoload.php');
use App\User;
User::isloging();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Publiés</title>


    <link rel="stylesheet" href="stylecard.css">
</head>

<body>
    
    <div class="topbar">
        <div class="container">
            
            <a href="/devblog%20brief/pages/all_articles.php" class="brand">Dev Blog</a>
            
            <div class="welcome">
                <span>Hello, <?php echo $_SESSION['username']; ?>!</span> 
            </div>
            
            <div class="nav-links">

                <a href="/devblog brief/classes/logout.php" class="btn logout-btn">Logout</a>
            </div>
        </div>
    </div>


    <div class="container content-container">
        <h1 class="title">Recents Articles</h1>

        <div class="articles">
            <?php  
                require realpath(__DIR__.'/../vendor/autoload.php');
                use App\Article;
                use App\config\Database;
                $conn = Database::connect();
                $article = new Article();
                $articles = $article->getPublishedArticles($conn);
            ?>


            <?php foreach($articles as $article): 
                $date = Article::nicetime(date('d M, Y', strtotime($article['created_at'])));
                ?>
                
                <div class="article-card">
                    <img src="../public/articles/uploads/<?= htmlspecialchars($article['featured_image']) ?>" alt="Article Image" class="article-image">
                    <div class="article-info">
                        <h3 class="article-title"><?= htmlspecialchars($article['title']) ?></h3>
                        <p><?php echo $date; ?> </p>
                        <p class="article-excerpt"><?= htmlspecialchars(substr($article['content'], 0, 100)) ?>...</p>
                        <p class="article-meta">By: <?= htmlspecialchars($article['author_name']) ?> | Category: <?= htmlspecialchars($article['category_name']) ?></p>
                        <a href="/devblog%20brief/pages/single_article.php?id=<?= $article['id'] ?>" class="btn read-more-btn">See more</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
