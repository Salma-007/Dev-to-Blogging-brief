<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Publiés</title>
    <!-- Inclure Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJxjz1hX9N4Ck9r5W9b9kA72KzTbgftAf0WPTvqC7s8mk2RU1f4X2hpPGl2x" crossorigin="anonymous">
    <link rel="stylesheet" href="stylecard.css">
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
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach($articles as $article): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="path/to/article-image.jpg" class="card-img-top" alt="Article Image">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($article['content'], 0, 100)) ?>...</p>
                            <p class="text-muted">Par: <?= htmlspecialchars($article['author_name']) ?> | Catégorie: <?= htmlspecialchars($article['category_name']) ?></p>
                            <a href="view-article.php?id=<?= $article['id'] ?>" class="btn btn-primary">Voir Plus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    <!-- Inclure les scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0O4+zI1u2UPqa5ShP8p4E9/Qppx7g8A9IKqFjzWgsGLfvzJm" crossorigin="anonymous"></script>
</body>
</html>