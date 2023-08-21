<?php 

class Connexion {
    private $conn;

    public function __construct() {
        $connectionString = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
        try {
            $this->conn = new PDO($connectionString, DB_USER, DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexión exitosa";
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }

    }
    public function connect() {
        return $this->conn;
    }

}