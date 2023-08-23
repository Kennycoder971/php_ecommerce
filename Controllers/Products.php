<?php 

class Products extends Controller {
    public function __construct() {
       parent::__construct();
    }
    
    public function products($params) {
         $data['page_id'] = 1;
         $data['tag_page'] = "products";
         $data['page_title'] = "Products page";
         $data['page_name'] = "products";
         $this->views->getView($this,'products', $data);
    }

}