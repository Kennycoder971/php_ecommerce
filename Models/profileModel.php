<?php 

class profileModel extends Mysql {
    public function __construct() {
        parent::__construct();
    } 

    public function updateUserById(int $id, string $username, string $email) {
        $query = "UPDATE user SET username = ?, email = ? WHERE id = $id";
        $arrData = array($username, $email);
        $isSuccess = $this->update($query, $arrData);
        return $isSuccess;
    }

    public function updatePasswordById(int $id, string $password) {
        $query = "UPDATE user SET password = ? WHERE id = $id";
        $arrData = array(generateBcryptPassword($password));
        $isSuccess = $this->update($query, $arrData);
        return $isSuccess;
    }
}