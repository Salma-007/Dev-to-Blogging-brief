<?php
namespace App;
require '../../vendor/autoload.php';
use PDO;

class Categorie{
    private $id;
    private $name;
    private $description;
    // protected $articles = [];

    public function __construct($nom = null, $description = null, $id = -1)
    {
        $this->name = $nom;
        $this->description = $description;
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    // ajouter une catégorie 
    public function addCategory($db) {
        $sql = "INSERT INTO categories (nom_category, description) VALUES (:name, :description)";
        $stmt = $db->prepare($sql);
        $stmt->execute(['name' => $this->name,'description' => $this->description]);
    }

    // modifier une catégorie
    public function updateCategory($db) {
        $sql = "UPDATE categories SET nom_category = :name, description = :description WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['name' => $this->name,'description' => $this->description, 'id' => $this->id]);
    }

    // supprimer une catégorie
    public function deleteCategory($db) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $this->id]);
    }

    // recuperer une categorie
    public function getcategorie($db){
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        return ( $stmt->fetch(PDO::FETCH_ASSOC));
    }
   
    // recuperation de toutes les catégories
    public static function getAllCategories($db) {
        $sql = "SELECT * FROM categories";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // get categorie state for the dashboard
    public function getCategoryStats($conn){
        $sql = "SELECT COUNT(*) as article_count, categories.nom_category as category_name FROM articles JOIN categories ON articles.category_id = categories.id GROUP BY category_name;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }

}




?>