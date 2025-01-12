<?php
namespace App;
require realpath(__DIR__.'/../vendor/autoload.php');

use App\Categorie;
use App\User;
use App\config\Database;
use App\Crud;
use PDO;

class Article{
    private $id;
    private $title;
    private $slug;
    private $content;
    private $meta_description;
    private $category_id;
    private $img;
    private $status;
    private $auteur_id;
    private $created_at;
    private $updated_at;
    private $views;
    public $conn;

    public function __construct($title = null, $slug = null, $content = null, $description = null, $category_id = null , $status = 'pending', $id = -1){
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->content = $content;
        $this->meta_description = $description;
        $this->category_id = $category_id;
        // $this->img = $img;
        $this->status = $status;
        // $this->auteur_id = $auteur;
        // $this->created_at = $created_at;
        $this->conn = Database::connect();

    }

    public function setImage($img){
        $this->img = $img;
    }

    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
    }

    public function setAuteurID($id){
        $this->auteur_id = $id;
    }

    public function setSlug($slug){
        $this->slug = $slug;
    }

    public function getPublishedArticles($conn){
        $query = "select articles.id, title, content,users.username AS author_name, 
                        categories.nom_category AS category_name, featured_image, updated_at from articles 
                        LEFT JOIN 
                        users ON articles.auteur_id = users.id
                    LEFT JOIN 
                        categories ON articles.category_id = categories.id 
                        where status = 'accepted' order by created_at desc;";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllArticles(){
        $query = "SELECT 
                        articles.id, 
                        articles.title, 
                        users.username AS author_name, 
                        categories.nom_category AS category_name, 
                        GROUP_CONCAT(tags.nom_tag) AS tags, 
                        status,
                        articles.views, 
                        articles.created_at,
                        articles.updated_at
                    FROM 
                        articles 
                    LEFT JOIN 
                        users ON articles.auteur_id = users.id
                    LEFT JOIN 
                        categories ON articles.category_id = categories.id 
                    LEFT JOIN 
                        article_tags ON articles.id = article_tags.article_id
                    LEFT JOIN 
                        tags ON article_tags.tag_id = tags.id
                    GROUP BY 
                        articles.id, articles.title, users.username, categories.nom_category, articles.views, articles.created_at";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //tout article par auteur
    public function getAllArticlesByAuthor($id){
        $query = "SELECT 
                        articles.id, 
                        articles.title, 
                        users.username AS author_name, 
                        categories.nom_category AS category_name, 
                        GROUP_CONCAT(tags.nom_tag) AS tags, 
                        status,
                        articles.views, 
                        articles.created_at,
                        articles.updated_at
                    FROM 
                        articles 
                    LEFT JOIN 
                        users ON articles.auteur_id = users.id
                    LEFT JOIN 
                        categories ON articles.category_id = categories.id 
                    LEFT JOIN 
                        article_tags ON articles.id = article_tags.article_id
                    LEFT JOIN 
                        tags ON article_tags.tag_id = tags.id
                    where users.id = :id
                    GROUP BY 
                        articles.id, articles.title, users.username, categories.nom_category, articles.views, articles.created_at";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    // methode d'ajout d'un article
    public function addArticle($conn){
        $sql = "INSERT INTO articles (title, slug, content, meta_description, featured_image, category_id, auteur_id, status) VALUES (:title, :slug, :content, :meta_description, :featured_image, :category_id, :auteur_id, :status)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'title' => $this->title,
            'slug' => $this->slug, 
            'content' => $this->content,
            'meta_description' => $this->meta_description,
            'featured_image' => $this->img,  
            'category_id' => $this->category_id,
            'auteur_id' => $this->auteur_id, 
            'status' => 'pending'
        ]);
        
        return $lastId = $conn->lastInsertId();    
    }

    // slug generator
    function create_slug($string) {
        // Replace non letter or digits by -
        $string = preg_replace('~[^\pL\d]+~u', '-', $string);
    
        // Transliterate
        if (function_exists('iconv')) {
            $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
        }
    
        // Remove unwanted characters
        $string = preg_replace('~[^-\w]+~', '', $string);
    
        // Trim
        $string = trim($string, '-');
    
        // Remove duplicate -
        $string = preg_replace('~-+~', '-', $string);
    
        // Lowercase
        $string = strtolower($string);
    
        // If string is empty, return 'n-a'
        if (empty($string)) {
            return 'n-a';
        }
        $this->setSlug($string);
        
        return $string;
    }

    // methode de suppression
    public function deletearticle($conn){
        $sql = "DELETE FROM articles WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);
    }

    // methode pour recuperer un article
    public function getArticle($conn){
        $sql = "SELECT 
                    articles.id, 
                    articles.title as title, 
                    featured_image,
                    articles.content as content,
                    users.username as author_name,
                    created_at,
                    articles.meta_description as meta_description,
                    categories.nom_category AS category_name, 
                    GROUP_CONCAT(tags.nom_tag) AS tags
                FROM 
                    articles 
                LEFT JOIN 
                    categories ON articles.category_id = categories.id 
                LEFT JOIN 
                    article_tags ON articles.id = article_tags.article_id
                LEFT JOIN 
                    tags ON article_tags.tag_id = tags.id
                JOIN users on users.id = articles.auteur_id
                where articles.id = :id
                GROUP BY 
                    articles.id, articles.title, categories.nom_category ;";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // methode update article
    public function updateArticle($conn){
        $sql = "UPDATE articles SET title = :title, content = :content, meta_description = :meta_description, category_id = :category_id WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['title' => $this->title,'content' => $this->content,'meta_description' => $this->meta_description,'category_id' => $this->category_id, 'id' => $this->id]);
        return $lastId = $conn->lastInsertId(); 
    }

    //accept article
    public function acceptArticle($conn){
        $sql = "UPDATE articles SET status = 'accepted' WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);
    }

    //refuse article
    public function refuseArticle($conn){
        $sql = "UPDATE articles SET status = 'refused' WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);
    }

    // methode  pour incrementer views
    public function incrementViews($id) {
        $query = "UPDATE articles 
                 SET views = CASE WHEN views IS NOT NULL THEN views + 1 ELSE 1 END 
                 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $this->id]);
    }

    //date function
    public static function nicetime($date){
    if(empty($date)) {
        return "No date provided";
    }
    
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60","60","24","7","4.35","12","10");
    
    $now = time();
    $unix_date = strtotime($date);
    
       // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference = $now - $unix_date;
        $tense = "ago";
        
    } else {
        $difference = $unix_date - $now;
        $tense = "from now";
    }  
    
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j].= "s";
    }
    
    return "$difference $periods[$j] {$tense}";
}

    //search an article by title
    public function searchbyTitle($title){
        // $sql = "select * from articles where title like '%:title%' limit 3";
        $sql = "select articles.id, title, content,users.username AS author_name, 
                        categories.nom_category AS category_name, featured_image, updated_at from articles 
                        LEFT JOIN 
                        users ON articles.auteur_id = users.id
                    LEFT JOIN 
                        categories ON articles.category_id = categories.id 
                        where status = 'accepted' and title like '%$title%' order by created_at desc limit 3;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}



?>