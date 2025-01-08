<?php
// Inclure la configuration et la classe Article
require realpath(__DIR__.'/../vendor/autoload.php');
use App\Article;
use App\config\Database;

// Connexion à la base de données
$conn = Database::connect();

// Obtenez l'ID de l'article à partir de l'URL
$articleId = $_GET['id'] ;
// echo $articleId;
$article = new Article(null,null,null,null,null,null,$articleId);
$articleDetails = $article->getArticle($conn); 
// var_dump($articleDetails);
if (!$articleDetails) {
    echo "Article non trouvé.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($articleDetails[0]['title']) ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <!-- Affichage de l'article -->
            <div class="card">
                <img src="../public/articles/uploads/<?= htmlspecialchars($articleDetails[0]['featured_image']) ?>" class="card-img-top" style ="width:600px; margin: 0 auto;" alt="Image de l'article">
                <div class="card-body">
                    <h1 class="card-title"><?= htmlspecialchars($articleDetails[0]['title']) ?></h1>
                    <p class="text-muted">Par: <?= htmlspecialchars($articleDetails[0]['author_name']) ?> | Catégorie: <?= htmlspecialchars($articleDetails[0]['category_name']) ?></p>
                    <hr>
                    <div class="content">
                        <p><?= nl2br(htmlspecialchars($articleDetails[0]['content'])) ?></p>
                    </div>
                    <a href="/devblog brief/public/articles/index.php" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (si nécessaire) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
