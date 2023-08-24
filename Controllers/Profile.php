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
}