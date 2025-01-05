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


}
