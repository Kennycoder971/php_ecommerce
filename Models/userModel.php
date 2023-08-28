<?php 

class userModel extends Mysql {
    public function getUserById(int $id) {
        $query = "SELECT * FROM user WHERE id = $id";
        $user = $this->select($query);
        return $user;
    }

    public function getUserProductsById($id) {
        $query = "SELECT product.id, product.title, product.price, productImages.imgUrl 
                  FROM product
                  LEFT JOIN productImages
                  ON product.id = productImages.productId
                  WHERE product.userId = $id";
        $products = $this->select_all($query);
        return $products;
    }
}