<?php 

class Mysql extends Connexion {
    private $conn;
    private $strquery;
    private $arrValues;

    function __construct() {
        $this->conn = new Connexion();
        $this->conn = $this->conn->connect();
    }

    // Insert a record  
    public function insert (string $query, array $arrValues) {
        $this->strquery = $query;
        $this->arrValues = $arrValues;
        $insert = $this->conn->prepare($this->strquery);
        $resInsert = $insert->execute($this->arrValues);
        if ($resInsert) {
            $lastInsert = $this->conn->lastInsertId();
        } else {
            $lastInsert = 0;
        }
        return $lastInsert;
    }

    // Select a record
    public function select (string $query) {
        $this->strquery = $query;
        $result = $this->conn->prepare($this->strquery);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    // Select all records
    public function select_all (string $query) {
        $this->strquery = $query;
        $result = $this->conn->prepare($this->strquery);
        $result->execute();
        $data = $result->fetchall(PDO::FETCH_ASSOC);
        return $data;
    }
    
    // Update a record
    public function update (string $query, array $arrValues) {
        $this->strquery = $query;
        $this->arrValues = $arrValues;
        $update = $this->conn->prepare($this->strquery);
        $resExecute = $update->execute($this->arrValues);
        return $resExecute;
    }

    // Delete a record
    public function delete (string $query) {
        $this->strquery = $query;
        $result = $this->conn->prepare($this->strquery);
        $del = $result->execute();
        return $del;
    }

}