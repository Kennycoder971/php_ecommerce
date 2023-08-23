<?php 

class authModel extends Mysql{
    public function __construct() {
        parent::__construct();
    }

    public function register(string $name, string $email, string $password, int $isSeller) {
        $query = "SELECT * FROM user WHERE email = '$email'";
        $request = $this->select($query);
        if(empty($request)) {
            $query_insert = "INSERT INTO user(username, email, password, isSeller) VALUES(?,?,?,?)";
            $arrData = array($name, $email, generateBcryptPassword($password), $isSeller);
            $request_insert = $this->insert($query_insert, $arrData);
            return $request_insert;
        } else {
            return "exist";
        }
    }

    public function login(string $email) {
        $query = "SELECT * FROM user WHERE email = '$email'";
        $user = $this->select($query);
        return $user;
    }
} 