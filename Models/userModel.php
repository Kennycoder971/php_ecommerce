<?php 

class userModel extends Mysql {
    public function getUserById(int $id) {
        $query = "SELECT * FROM user WHERE id = $id";
        $user = $this->select($query);
        return $user;
    }
}