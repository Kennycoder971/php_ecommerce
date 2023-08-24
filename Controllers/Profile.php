<?php 

class Profile extends Controller {
    public function index() {
        $data['page_title'] = 'Profile';
        $user = getUserSession();
        $this->views->getView($this,'profile', $data);
    }
}