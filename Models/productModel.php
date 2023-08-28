<?php 

class productModel extends Mysql {
    public function __construct() {
        parent::__construct();
    }

    public function getProductById($id) {
        $query = "SELECT *
                  FROM product
                  LEFT JOIN productImages ON product.id = productImages.productId
                  WHERE product.id = $id ";
        $products = $this->select($query);
        return $products;
    }

    public function insertProduct($title, $description, $stock, $price, $userId) {
        $query = "INSERT INTO product (title, description, stock, price, userId) VALUES (?,?,?,?,?)";
        $arrData = array($title, $description, $stock, $price,$userId);
        $request = $this->insert($query, $arrData);
        return $request;
    }

    public function updateProductById($id, $title, $description, $stock, $price) {
        $query = "UPDATE product SET title = ?, description = ?, stock = ?, price = ? WHERE id = $id";
        $arrData = array($title, $description, $stock, $price);
        $request = $this->update($query, $arrData);
        return $request;
    }
    public function deleteProductById($id) {
        $query = "DELETE FROM product WHERE id = $id";
        $request = $this->delete($query);
        return $request;
    }
    public function uploadProductImage($productId, $imageUrl) {
        $query = "INSERT INTO productImages (productId, imgUrl) VALUES (?,?)";
        $arrData = array($productId, $imageUrl);
        $request = $this->insert($query, $arrData);
        return $request;
    }
    
}