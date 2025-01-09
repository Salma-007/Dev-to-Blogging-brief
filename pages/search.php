<?php
require realpath(__DIR__.'/../vendor/autoload.php');
use App\Article;
use App\config\Database;

$conn = Database::connect();
$article = new Article();

if (isset($_POST['search'])) {
    if(!empty($_POST['search'])){
        $search = $_POST['search']; 
        $articles = $article->searchbyTitle($search); 
    } else {
        $articles = $article->getPublishedArticles($conn);
    }
}


foreach ($articles as $article) {
    $date = Article::nicetime(date('d M, Y', strtotime($article['updated_at'])));
    ?>
    <div class="article-card">
        <img src="../public/articles/uploads/<?= htmlspecialchars($article['featured_image']) ?>" alt="Article Image" class="article-image">
        <div class="article-info">
            <h3 class="article-title"><?= htmlspecialchars($article['title']) ?></h3>
            <p><?php echo $date; ?> </p>
            <p class="article-excerpt"><?= htmlspecialchars(substr($article['content'], 0, 100)) ?>...</p>
            <p class="article-meta">By: <?= htmlspecialchars($article['author_name']) ?> | Category: <?= htmlspecialchars($article['category_name']) ?></p>
            <a href="/devblog brief/public/articles/controller-article.php?action=voir&id=<?= $article['id'] ?>" class="btn read-more-btn">See more</a>
        </div>
    </div>
    <?php
}
