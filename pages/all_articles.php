<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Publiés</title>
    <!-- Inclure Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJxjz1hX9N4Ck9r5W9b9kA72KzTbgftAf0WPTvqC7s8mk2RU1f4X2hpPGl2x" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Articles Publiés</h1>
        <?php  
            require '../../vendor/autoload.php';
            use App\Article;
            use App\config\Database;
            $conn = Database::connect();
            $article = new Article();
            $result = $article->getPublishedArticles($conn);
        ?>
        <?php if ($result->num_rows > 0): ?>
            <div class="row">
                <?php while($article = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <?php if (!empty($article['image_url'])): ?>
                                <img src="<?php echo $article['image_url']; ?>" class="card-img-top" alt="Image de l'article">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($article['title']); ?></h5>
                                <p class="card-text">
                                    <?php echo htmlspecialchars(substr($article['content'], 0, 150)) . '...'; ?>
                                </p>
                                <a href="article.php?id=<?php echo $article['id']; ?>" class="btn btn-primary">Lire plus</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-center">Aucun article publié trouvé.</p>
        <?php endif; ?>
    </div>

    <!-- Inclure les scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0O4+zI1u2UPqa5ShP8p4E9/Qppx7g8A9IKqFjzWgsGLfvzJm" crossorigin="anonymous"></script>
</body>
</html>