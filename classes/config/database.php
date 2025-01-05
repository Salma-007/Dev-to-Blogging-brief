<?php
namespace App\config;
require realpath(__DIR__.'/../../vendor/autoload.php');

use Dotenv\Dotenv;
use PDO;    
use PDOException;


class Database {
    private static $connection;

    public static function connect() {
        if (!self::$connection) {
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->load();

            $host = $_ENV['DB_SERVER'];
            $dbname = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];

            try {
                self::$connection = new PDO(
                    "mysql:host=$host;dbname=$dbname",
                    $user,
                    $password
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$connection;
    }
    // public static function test(){
    //     echo "stop fix";
    // }
}

?>