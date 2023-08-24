<?php 

class Auth extends Controller{
    public function register() {
        $data['page_title'] = 'Register';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = strClean($_POST['username']);
            $email = strClean($_POST['email']);
            $password = strClean($_POST['password']);
            $password2 = strClean($_POST['password2']);
            $isSeller = isset($_POST['isSeller']) ? 1 : 0;
            
            if($password != $password2) {
                $data['alert'] = ['type' => 'danger', 'message' => 'Passwords do not match'];
                $this->views->getView($this,'register', $data);
                return;
            } 

            try {
                $request = $this->model->register($name, $email, $password, $isSeller);
                if(is_numeric($request)) {
                    $user = $this->model->getUserById($request);
                    setSession($user);
                    header('Location: '.base_url().'?msg=success');
                    return;
                } 
                
                if($request == 'exist') {
                    $data['alert'] = ['type' => 'danger', 'message' => 'User already exists'];
                } else {
                    $data['alert'] = ['type' => 'danger', 'message' => 'Error registering user'];
                }
            } catch (\PDOException $e) {
                $data['alert'] = ['type' => 'danger', 'message' => 'Error registering user'.$e->getMessage()];
            }
            
            
        }
        $this->views->getView($this,'register', $data);
    }

    public function login() {
        $data['page_title'] = 'Login';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = strClean($_POST['email']);
            $password = strClean($_POST['password']);
            
            try {
                $user = $this->model->login($email);
                if(!empty($user) && password_verify($password, $user['password'])) {
                    setSession($user);
                    header('Location: '.base_url());
                    return;
                } else {
                    $data['alert'] = ['type' => 'danger', 'message' => 'Email or password incorrect'];
                }
            } catch (\PDOException $e) {
                $data['alert'] = ['type' => 'danger', 'message' => 'Error logging in'.$e->getMessage()];
            }
        }
        $this->views->getView($this,'login', $data);
    }

    public function logout() {
        destroySession();
        var_dump('Hello');
        header('Location: '.base_url());
    }
}