<?php 

class productModel extends Mysql {
    public function __construct() {
        parent::__construct();
    }

    public function getUserProductsById($id) {
        $query = "SELECT * FROM product WHERE userId = $id";
        $products = $this->select($query);
        return $products;
    }

    public function insertProduct($title, $description, $stock, $price, $userId) {
        $query = "INSERT INTO product (title, description, stock, price, userId) VALUES (?,?,?,?,?)";
        $arrData = array($title, $description, $stock, $price,$userId);
        $request = $this->insert($query, $arrData);
        return $request;
    }

    public function uploadProductImage($productId, $imageUrl) {
        $query = "INSERT INTO productImages (productId, imgUrl) VALUES (?,?)";
        $arrData = array($productId, $imageUrl);
        $request = $this->insert($query, $arrData);
        return $request;
    }
    
}