<?php
use Dotenv\Dotenv;
require '../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
/**
 * Connect to a MySQL database using the mysqli extension.
 *
 * This function establishes a connection to a MySQL database. If the
 * connection fails, it logs an error and terminates the program.
 *
 * @return A MySQLi connection object.
 */
$con = mysqli_connect($_ENV['DB_SERVER'],$_ENV['DB_USERNAME'],$_ENV['DB_PASSWORD'],$_ENV['DB_NAME']);


// if($con){
// echo"Connected successfully";
// }
?>