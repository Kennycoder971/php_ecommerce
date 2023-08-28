<?php 

class Profile extends Controller {
    public function index() {
        $data['page_title'] = 'Profile';
        $user = getUserSession();
        $data['user'] = $user;
        $this->views->getView($this,'profile', $data);
    }

    public function update () {
        $user = getUserSession();
        $id = $user['id'];
        $data['user'] = $user;
        $data['page_title'] = 'Profile';
        $username = strClean($_POST['username']);
        $email = strClean($_POST['email']);
       
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            header('Location: '.base_url().'profile/index');
            return;
        }       

        try {
            $isUpdateSuccess = $this->model->updateUserById($id, $username, $email);
            if($isUpdateSuccess) {
                $userModel = $this->loadModelByName('User');
                $user = $userModel->getUserById($id);
                $data['user'] = $user;
                setSession($user);
                $data['alert'] = ['type' => 'success', 'message' => 'Profile updated successfully'];
            } else {
                $data['alert'] = ['type' => 'danger', 'message' => 'Error updating profile'];
            }
        } catch (\PDOException $e) {
            $data['alert'] = ['type' => 'danger', 'message' => 'Error updating profile'.$e->getMessage()];
        }

        $this->views->getView($this,'profile', $data);
    }

    public function security () {
        $data['page_title'] = 'Security';
        $user = getUserSession();
        $data['user'] = $user;
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = strClean($_POST['currentPassword']);
            $newPassword = strClean($_POST['newPassword']);
            $confirmPassword = strClean($_POST['confirmPassword']);
    
            if(empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                $data['alert'] = ['type' => 'danger', 'message' => 'All fields are required'];
                $this->views->getView($this,'security', $data);
                return;
            }
    
            if(!password_verify($currentPassword, $user['password'])) {
                $data['alert'] = ['type' => 'danger', 'message' => 'Current password is incorrect'];
                $this->views->getView($this,'security', $data);
                return;
            }
    
            if($newPassword !== $confirmPassword) {
                $data['alert'] = ['type' => 'danger', 'message' => 'New password and confirm password must be the same'];
                $this->views->getView($this,'security', $data);
                return;
            }
    
            try {
                $isUpdateSuccess = $this->model->updatePasswordById($user['id'], $newPassword);
                if($isUpdateSuccess) {
                    $data['alert'] = ['type' => 'success', 'message' => 'Password updated successfully'];
                } else {
                    $data['alert'] = ['type' => 'danger', 'message' => 'Error updating password'];
                }
            } catch (\PDOException $e) {
                $data['alert'] = ['type' => 'danger', 'message' => 'Error updating password'.$e->getMessage()];
            }
        }

        $this->views->getView($this,'security', $data);
    }

    public function addProducts () {
        $data['page_title'] = 'Add product';
        $user = getUserSession();
        $data['user'] = $user;

        if($_SERVER['REQUEST_METHOD'] === 'GET'&& $user['isSeller'] == 0) {
            $this->views->getView($this,'profile', $data);
            return;
        }
        
        if($_SERVER['REQUEST_METHOD'] === "POST") {
            $title = strClean($_POST['title']);
            $description = strClean($_POST['description']);
            $stock = strClean($_POST['stock']);
            $price = strClean($_POST['price']);
            $image = isInputFileEmpty('image') ?  null : $_FILES['image'];

            if(empty($title) || empty($description) || empty($stock) || empty($price)) {
                $data['alert'] = ['type' => 'danger', 'message' => 'Title, description, stock and price are required'];
                $this->views->getView($this,'addProduct', $data);
                return;
            }

            try {
                $productModel = $this->loadModelByName('Product');
                
                // if no image was uploaded
                if(empty($image)) {
                    $isInsertSuccess = $productModel->insertProduct($title, $description, $stock, $price, $user['id']);

                    if($isInsertSuccess) {
                        $data['alert'] = ['type' => 'success', 'message' => 'Product added successfully'];
                    } else {
                        $data['alert'] = ['type' => 'danger', 'message' => 'Error adding product'];
                        $this->views->getView($this,'addProduct', $data);
                        return;
                    }
                }

                // if image was uploaded
                if(!empty($image)) {
                    $imageError = uploadImage('image');
                    // if there is and error while uploading the image
                    if(!empty($imageError['error'])) {
                        $data['alert'] = ['type' => 'danger', 'message' => $imageError['error']];
                        $this->views->getView($this,'addProduct', $data);
                        return;
                    }

                    // if there is no error while uploading the image
                    $imageUrl = $imageError['targetFile'];
                    $isInsertSuccess = $productModel->insertProduct($title, $description, $stock, $price, $user['id']);
                    $isInsertImageSuccess = $productModel->uploadProductImage($isInsertSuccess, $imageUrl);
                    $data['alert'] = ['type' => 'success', 'message' => 'Product added successfully'];
                    $this->views->getView($this,'addProduct', $data);
                    return;
                    
                }

            } catch (\PDOException $e) {
                $data['alert'] = ['type' => 'danger', 'message' => 'Error adding product'.$e->getMessage()];
            }
            
        }
        $this->views->getView($this,'addProduct', $data);

    }

    public function myProducts () {
        $data['page_title'] = 'My products';
        $user = getUserSession();
        $data['user'] = $user;
        $userModel = $this->loadModelByName('User');
        try {
            $products = $userModel ->getUserProductsById($user['id']);
            $data['products'] = $products; 
        } catch (\PDOException $e) {
            $data['alert'] = ['type' => 'danger', 'message' => 'Error getting products'.$e->getMessage()];
        }
        $this->views->getView($this,'myProducts', $data);
    }

    public function editProduct ($productId) {
        $data['page_title'] = 'My products';
        $user = getUserSession();
        $data['user'] = $user;
        
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $productModel = $this->loadModelByName('Product');
            try {
                $product = $productModel->getProductById(strClean($productId));
                
                if(!$product){
                    $data['alert'] = ['type' => 'danger', 'message' => 'Product not found'];
                    header('Location: '.base_url().'profile/myProducts');
                    return;
                }
                if($product['userId'] !== $user['id']) {
                    $data['alert'] = ['type' => 'danger', 'message' => 'You are not authorized to edit this product'];
                    header('Location: '.base_url().'profile/myProducts');
                    return;
                }
                $data['product'] = $product;   
               
            } catch (\PDOException $e) {
                $data['alert'] = ['type' => 'danger', 'message' => 'Error getting product'.$e->getMessage()];
            }
            $this->views->getView($this,'editProduct', $data);
            return;
        }

        if($_SERVER['REQUEST_METHOD'] === "POST") {
            $title = strClean($_POST['title']);
            $description = strClean($_POST['description']);
            $stock = strClean($_POST['stock']);
            $price = strClean($_POST['price']);

            if(empty($title) || empty($description) || empty($stock) || empty($price)) {
                $data['alert'] = ['type' => 'danger', 'message' => 'Title, description, stock and price are required'];
                try {
                    $productModel = $this->loadModelByName('Product');
                    $product = $productModel->getProductById(strClean($productId));
                    $data['product'] = $product;
                } catch (\Throwable $e) {
                    $data['alert'] = ['type' => 'danger', 'message' => 'Error getting product'.$e->getMessage()];
                }
                $this->views->getView($this,'editProduct', $data);
                return;
            }

            try {
                $productModel = $this->loadModelByName('Product');
                
                $isInsertSuccess = $productModel->updateProductById($productId,$title, $description, $stock, $price, $user['id']);

                if($isInsertSuccess) {
                    
                    $data['alert'] = ['type' => 'success', 'message' => 'Product modified successfully'];
                    $product = $productModel->getProductById(strClean($productId));
                    $data['product'] = $product;
                    $this->views->getView($this,'editProduct', $data);
                    return;
                } else {
                    $data['alert'] = ['type' => 'danger', 'message' => 'Error adding product'];
                    $this->views->getView($this,'editProduct', $data);
                    return;
                }

            } catch (\PDOException $e) {
                $data['alert'] = ['type' => 'danger', 'message' => 'Error adding product'.$e->getMessage()];
            }
            $this->views->getView($this,'editProduct', $data);
        }

    }
    
    public function deleteProduct($productId) {
        $data['page_title'] = 'My products';
        $user = getUserSession();
        $data['user'] = $user;
        $productModel = $this->loadModelByName('Product');
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $productModel = $this->loadModelByName('Product');
            try {
                $product = $productModel->getProductById(strClean($productId));
                
                if(!$product){
                    header('Location: '.base_url().'profile/myProducts');
                    return;
                }
                if($product['userId'] !== $user['id']) {
                    header('Location: '.base_url().'profile/myProducts');
                    return;
                }
            
                $isDeleteSuccess = $productModel->deleteProductById($productId);
                header('Location: '.base_url().'profile/myProducts');
                return;
            } catch (\PDOException $e) {
                $data['alert'] = ['type' => 'danger', 'message' => 'Error getting product'.$e->getMessage()];
            }
            $this->views->getView($this,'editProduct', $data);
            return;
        }
    }
}