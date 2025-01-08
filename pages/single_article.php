<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require realpath(__DIR__.'/../vendor/autoload.php');
    use App\Article;
    use App\config\Database;


    $conn = Database::connect();


    $articleId = $_GET['id'];
    $article = new Article(null,null,null,null,null,null,$articleId);
    $articleDetails = $article->getArticle($conn);

    $date = Article::nicetime(date('d M, Y', strtotime($articleDetails[0]['created_at'])));
    // echo $date;

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
    <link rel="stylesheet" href="style.css"> 
</head>
<body>


<div class="topbar">
    <div class="container">
        <a href="/devblog%20brief/pages/all_articles.php" class="brand">Dev Blog</a>
        
        <div class="nav-links">
            <a href="/devblog brief/classes/logout.php" class="btn logout-btn">Logout</a>
        </div>
    </div>
</div>


<div class="container my-5 article-detail">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-img-container">
                    <img src="../public/articles/uploads/<?= htmlspecialchars($articleDetails[0]['featured_image']) ?>" 
                         class="card-img-top" alt="Article Image">
                </div>
                <div class="card-body">
                    <h1 class="card-title"><?= htmlspecialchars($articleDetails[0]['title']) ?></h1>
                    <p class="text-muted">
                        <strong>By:</strong> <?= htmlspecialchars($articleDetails[0]['author_name']) ?> | 
                        <strong>Category:</strong> <?= htmlspecialchars($articleDetails[0]['category_name']) ?> | 
                        <strong>Pulished on:</strong> <?= date('d M, Y', strtotime($articleDetails[0]['created_at'])) ?>
                    </p>
                    <div class="tags">
                        <strong>Tags:</strong> 
                        <?php 
                            $tags = explode(',', $articleDetails[0]['tags']);
                            foreach ($tags as $tag) {
                                echo "<span class='tag'>$tag</span>";
                            }
                        ?>
                    </div>
                    <hr>
                    <div class="content">
                        <p><?= nl2br(htmlspecialchars($articleDetails[0]['content'])) ?></p>
                    </div>
                    <?php if($_SESSION['role'] == 'visitor'){?>
                        <a href="/devblog brief/pages/all_articles.php" class="btn btn-primary mt-4">back</a>
                    <?php  }?>
                    <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'auteur'){?>
                        <a href="/devblog%20brief/public/users/index.php" class="btn btn-primary mt-4">back</a>
                    <?php  }?>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
