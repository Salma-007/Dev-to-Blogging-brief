<?php
namespace App;
require '../vendor/autoload.php';
use App\config\Database;
$conn = Database::connect();

class Crud{
    private $conn;

    public function __construct($conn) {
        $this->setConn($conn);
    } 
    public function setConn($conn){
        $this->conn = $conn;
    }

    // methode d'insertion 
    public static function insertRecord($conn, $table, $data) {
        // Use prepared statements to prevent SQL injection
        
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error in prepared statement: " . print_r($conn->errorInfo(), true));
        }
        // Execute the prepared statement
        $result = $stmt->execute(array_values($data));
        return $result;
    }

        // methode de suppression 
        public static function deleteRecord($conn, $table, $id) {

            $sql = "DELETE FROM $table WHERE id = :id";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Error in prepared statement: " . print_r($conn->errorInfo(), true));
            }
            $result = $stmt->execute([':id' => $id]);
            
            return $result;
        }

        // methode de update 
        function updateRecord($conn, $table, $data, $id) {
            $args = array();
        
            foreach ($data as $key => $value) {
                $args[] = "$key = ?";
            }
        
            $sql = "UPDATE $table SET " . implode(',', $args) . " WHERE id = ?";
        
            $stmt = $conn->prepare($sql);
        
            if (!$stmt) {
                die("Error in prepared statement: " . print_r($conn->errorInfo(), true));
            }

            $params = array_values($data);
            $params[] = $id;
        
            // Execute the prepared statement with the parameters
            $result = $stmt->execute($params);
        
            return $result;
        }

            //methode d'affichage de tous les joueurs
    public function listPlayers($conn,$table) {
        $query = "SELECT * FROM $table;";
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>