<?php 

class authModel extends Mysql{
    public function __construct() {
        parent::__construct();
    }

    public function register(string $name, string $email, string $password, int $isSeller) {
        $query = "SELECT * FROM user WHERE email = '$email'";
        $user = $this->select($query);
        if(empty($user)) {
            $query_insert = "INSERT INTO user(username, email, password, isSeller) VALUES(?,?,?,?)";
            $arrData = array($name, $email, generateBcryptPassword($password), $isSeller);
            $insertedId = $this->insert($query_insert, $arrData);
            return $insertedId;
        } else {
            return null;
        }
    }

    public function login(string $email) {
        $query = "SELECT * FROM user WHERE email = '$email'";
        $user = $this->select($query);
        return $user;
    }

    public function getUserById(int $id) {
        $query = "SELECT * FROM user WHERE id = $id";
        $user = $this->select($query);
        return $user;
    }
} 