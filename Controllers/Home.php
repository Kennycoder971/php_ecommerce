<?php 

class Home extends Controller {
    public function __construct() {
       parent::__construct();
    }
    
    public function home($params) {
         $data['page_title'] = "Home";
         $productModel = $this->loadModelByName('Product');
         try {
            $data['weeklyProducts'] = $productModel->getWeeklyProducts();
            $this->views->getView($this,'home', $data);
         } catch (\PDOException $e) {
            $data['error'] = "Error getting products";
         }
    }


}