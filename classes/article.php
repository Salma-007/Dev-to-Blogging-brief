<?php
namespace App;
require '../../vendor/autoload.php';
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
    private User $auteur;
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
        // $this->auteur = $auteur;
        // $this->created_at = $created_at;
        $this->conn = Database::connect();

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

    public function setSlug($slug){
        $this->slug = $slug;
    }

    public function getAllArticles(){
        $query = "SELECT 
                        articles.id, 
                        articles.title, 
                        users.username AS author_name, 
                        categories.nom_category AS category_name, 
                        GROUP_CONCAT(tags.nom_tag) AS tags, 
                        articles.views, 
                        articles.created_at
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

    // methode d'ajout d'un article
    public function addArticle($conn){
        $sql = "INSERT INTO articles (title, slug, content, meta_description, category_id, status) VALUES (:title, :slug, :content, :meta_description, :category_id, :status)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['title' => $this->title,'slug' => $this->slug, 'content' => $this->content,'meta_description' => $this->meta_description, 'category_id' => $this->category_id, 'status' => $this->status ]);
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
    



}



?>