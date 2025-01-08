<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Publiés</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="stylecard.css">
</head>

<body>
    <!-- Top Navbar -->
    <div class="topbar">
        <div class="container">
            <a href="#" class="brand">Mon Blog</a>
            <div class="nav-links">
                <a href="#">Accueil</a>
                <a href="#">Articles</a>
                <a href="#">À propos</a>
                <a href="#">Contact</a>
                <a href="/devblog brief/classes/logout.php" class="btn logout-btn">Déconnexion</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container content-container">
        <h1 class="title">Articles Publiés</h1>

        <div class="articles">
            <?php  
                require realpath(__DIR__.'/../vendor/autoload.php');
                use App\Article;
                use App\config\Database;
                $conn = Database::connect();
                $article = new Article();
                $articles = $article->getPublishedArticles($conn);
            ?>

            <!-- Loop through the articles and display them -->
            <?php foreach($articles as $article): ?>
                <div class="article-card">
                    <img src="../public/articles/uploads/<?= htmlspecialchars($article['featured_image']) ?>" alt="Article Image" class="article-image">
                    <div class="article-info">
                        <h3 class="article-title"><?= htmlspecialchars($article['title']) ?></h3>
                        <p class="article-excerpt"><?= htmlspecialchars(substr($article['content'], 0, 100)) ?>...</p>
                        <p class="article-meta">Par: <?= htmlspecialchars($article['author_name']) ?> | Catégorie: <?= htmlspecialchars($article['category_name']) ?></p>
                        <a href="/devblog brief/public/articles/controller-article.php?action=voir&id=<?= $article['id'] ?>" class="btn read-more-btn">Voir Plus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
