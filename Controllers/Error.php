<?php 

class Errors extends Controller {
    public function __construct() {
       parent::__construct();
    }
    
    public function notFound() {
         $this->views->getView($this,'error');
    }
}

$notFound = new Errors();
$notFound->notFound();