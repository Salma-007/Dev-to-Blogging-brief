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
    private Categorie $category;
    private $img;
    private $status;
    private User $auteur;
    private $created_at;
    private $updated_at;
    private $views;
    public $conn;

    public function __construct(){
        // $this->title = $title;
        // $this->slug = $slug;
        // $this->content = $content;
        // $this->meta_description = $description;
        // $this->category = $category;
        // $this->img = $img;
        // $this->status = $status;
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

    public function getAllArticles(){
        $query = "SELECT articles.id, title, users.username as author_name , categories.nom_category as category_name, tags.nom_tag as tags, views, created_at FROM articles 
                JOIN users ON articles.auteur_id = users.id
                JOIN categories ON articles.category_id = categories.id 
                JOIN article_tags ON articles.id = article_tags.article_id
                JOIN tags ON article_tags.tag_id = tags.id;";
        $stmt = $this->conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }




}



?>