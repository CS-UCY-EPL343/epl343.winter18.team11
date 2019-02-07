<?php
require_once 'configure.php';

class database_conf {
    private $conn;

    // Connecting to database
    public function getConnection() {

        // Connecting to mysql database
                try{
                     $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
                }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
        return $this->conn;
    }
}

?>
