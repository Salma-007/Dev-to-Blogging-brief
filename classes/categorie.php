<?php
namespace App;
require '../../vendor/autoload.php';
use PDO;
class Categorie{
    private $id;
    private $name;
    private $description;
    // protected $articles = [];

    public function __construct($nom, $description, $id = -1)
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
        $sql = "UPDATE categories SET nom_category = :name WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['name' => $this->name, 'id' => $this->id]);
    }

    // supprimer une catégorie
    public function deleteCategory($db) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $this->id]);
    }

    // recupere un article
    public function getcategorie($db){
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        var_dump($stmt->fetch(PDO::FETCH_ASSOC));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // recuperation de toutes les catégories
    public static function getAllCategories($db) {
        $sql = "SELECT * FROM categories";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}




?>