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
            require realpath(__DIR__.'/../vendor/autoload.php');
            use App\Article;
            use App\config\Database;
            $conn = Database::connect();
            $article = new Article();
            $articles = $article->getPublishedArticles($conn);
        ?>
        <?php foreach($articles as $article): ?>
            <div class="row" style = "display: flex; gap: 20px; margin: 50px;">
                <div>article 1 </div>
                <div>article 1 </div>
                <div>article 1 </div>

            </div>

            <!-- <p class="text-center">Aucun article publié trouvé.</p> -->
            <?php endforeach; ?>
    </div>

    <!-- Inclure les scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0O4+zI1u2UPqa5ShP8p4E9/Qppx7g8A9IKqFjzWgsGLfvzJm" crossorigin="anonymous"></script>
</body>
</html>