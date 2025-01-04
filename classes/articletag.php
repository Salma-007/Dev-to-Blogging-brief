<?php
namespace App;
use App\config\Database;
require '../../vendor/autoload.php';

class ArticleTag{
    private $id_tag;
    private $id_article;
    private $table = 'article_tags';
    private $crud;

    public function __construct($id_article, $id_tag){
        $this->id_tag = $id_tag;
        $this->id_article = $id_article;
        $conn = Database::connect();
        $this->crud  = new Crud($conn);

    }

    public function addArticleTag(){
        $data = [
            'article_id'=> $this->id_article,
            'tag_id'=> $this->id_tag
        ];
        return $this->crud->insertRecord($this->table, $data);
    }

}




?>