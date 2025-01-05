<?php
namespace App;
require '../../vendor/autoload.php';

use App\config\Database;
use App\Crud;
use PDO;

class User{
    private $id;
    private $username;
    private $email;
    private $password;
    private $crud;
    private $role;
    private $table = 'users';

    public function __construct($username = null, $email = null, $password = null, $id = -1, $role = 'visitor'){
        $conn = Database::connect();
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->crud  = new Crud($conn);
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    // fonction d'ajout un user
    public function insertUser(){
        $data = [
            'username'=> $this->username,
            'email'=> $this->email,
            'password_hash'=>password_hash($this->password, PASSWORD_DEFAULT),
            'role'=> $this->role
        ];
        return $this->crud->insertRecord($this->table, $data);
        
    }

    // get all authors
    public function getAuthors($conn){
        $sql = "SELECT * from users where role = 'auteur';";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    // get all visitors
    public function getVisitors($conn){
        $sql = "SELECT * from users where role = 'visitor';";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // assign role author to visitor
    public function assignRoleAuthor($conn){
        $sql = "UPDATE users SET role = 'auteur' WHERE id = :id;";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $this->id]);
    }

    //ban user
    public function banUser(){
        return $this->crud->deleteRecord($this->table, $this->id);
    }

    // get top authors
    public function getTopAuthors($conn){
        $sql = "select users.id as id, username, count(articles.id) as article_count, articles.views as total_views from users join articles on users.id = articles.auteur_id where role = 'auteur' GROUP BY users.id order by article_count limit 3;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //get top articles method
    public function getTopArticles($conn){
        $sql = "select articles.id, created_at, title, users.username as author_name, views from articles join users on articles.auteur_id = users.id where status = 'accepted' order by views limit 3;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }



}
