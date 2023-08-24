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
}