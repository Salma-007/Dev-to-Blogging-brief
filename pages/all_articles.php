<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require realpath(__DIR__.'/../vendor/autoload.php');
    use App\User;
    use App\config\Database;
    use App\Article;
    User::isloging();

    // $conn = Database::connect();
    // $article = new Article();
    // $articles = $article->getPublishedArticles($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles Publiés</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="stylecard.css">
</head>

<body>
    <div class="topbar">
        <div class="container">
            <a href="/devblog brief/pages/all_articles.php" class="brand">Dev Blog</a>
            <div class="welcome">
                <span>Hello, <?php echo $_SESSION['username']; ?>!</span>
            </div>
            <div class="nav-links">
                <a href="/devblog brief/classes/logout.php" class="btn logout-btn">Logout</a>
            </div>
        </div>
    </div>

    <div class="container content-container">
        <input type="text" id="search" placeholder="Search...">
        <h1 class="title">Recents Articles</h1>

        <div class="articles">
            
        </div>
    </div>

    <script>
        $(document).ready(function () {
            loadAllRecords(); 

            $('#search').on('keyup', function () {
                var query = $(this).val();
                if (query.length > 2) {
                    $.ajax({
                        url: 'search.php',
                        type: 'POST',
                        data: { search: query },
                        success: function (data) {
                            $('.articles').html(data); 
                        }
                    });
                } else {
                    loadAllRecords(); 
                }
            });

            function loadAllRecords() {
                $.ajax({
                    url: 'search.php',
                    type: 'POST',
                    data: { search: '' },
                    success: function (data) {
                        $('.articles').html(data); 
                    }
                });
            }
        });
    </script>
</body>
</html>
