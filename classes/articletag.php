<?php
namespace App;
use App\config\Database;
require '../../vendor/autoload.php';

class ArticleTag{
    private $id_tag;
    private $id_article;
    private $table = 'article_tags';
    private $crud;

    public function __construct($id_article, $id_tag = -1){
        $this->id_tag = $id_tag;
        $this->id_article = $id_article;
        $conn = Database::connect();
        $this->crud  = new Crud($conn);

    }
    // methode d'ajout au table pivot
    public function addArticleTag(){
        $data = [
            'article_id'=> $this->id_article,
            'tag_id'=> $this->id_tag
        ];
        return $this->crud->insertRecord($this->table, $data);
    }
    // methode de recuperation des tags d'un article par id
    public function getTagsbyArticle($conn){
        $sql = "SELECT tags.nom_tag FROM `article_tags` 
                JOIN tags ON article_tags.tag_id = tags.id 
                WHERE article_tags.article_id = :id;";
        $stmt= $conn->prepare($sql);
        $stmt->execute(['id' => $this->id_article]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // delete tags by article_id
    public function deleteTagsbyArticle($conn){
        $sql = "DELETE FROM article_tags WHERE article_id = :article_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['article_id' => $this->id_article]);

    }



}




?>