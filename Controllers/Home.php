<?php 

class Home extends Controller {
    public function __construct() {
       parent::__construct();
    }
    
    public function home($params) {
         $data['page_title'] = "Home";
         $this->views->getView($this,'home', $data);
    }

}