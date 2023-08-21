<?php 

class Home extends Controller {
    public function __construct() {
       parent::__construct();
    }
    
    public function home($params) {
         $data['page_id'] = 1;
         $data['tag_page'] = "Home";
         $data['page_title'] = "Página principal";
         $data['page_name'] = "home";
         $data['page_content'] = "Lorem ipsum dolor sit a met";
         $this->views->getView($this,'home', $data);
    }

}