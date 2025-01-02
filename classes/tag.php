<?php
namespace App;
require '../../vendor/autoload.php';
use App\config\Database;
use App\Crud;
use PDO;

class Tag{
    private $id;
    private $nom_tag;
    private $table = 'tags';
    private $crud;

    public function __construct($nom = null, $id = -1 ){
        $conn = Database::connect();
        $this->id = $id;
        $this->nom_tag = $nom;
        $this->crud  = new Crud($conn);
    }

    public function setNom($nom){
        $this->nom_tag = $nom;
    }

    public function getNom(){
        return $this->nom_tag;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    // fonction d'ajout
    public function insertTag(){
        $data = [
            'nom_tag'=> $this->nom_tag
        ];
        return $this->crud->insertRecord($this->table, $data);
        
    }

    // fonction suppression
    public function deleteTag(){
        return $this->crud->deleteRecord($this->table, $this->id);
    }
    
    // fonction update
    public function updateTag(){
        $data = [
            'nom_tag'=>$this->nom_tag
        ];
        return $this->crud->updateRecord($this->table, $data, $this->id);
    }

    // recuperation de toutes tags
    public function getAllTags(){
        return $this->crud->readRecords($this->table);
    }

}