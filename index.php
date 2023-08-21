<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once "Config/config.php";
require_once "Helpers/Helpers.php";

$url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';
$arrURL = explode('/', $url);
$controller = $arrURL[0];
$method = $arrURL[0];
$params = '';

if(!empty($arrURL[1])) {
    if($arrURL[1] != '') {
        $method = $arrURL[1];
    }
}

if(!empty($arrURL[2])) {
    if($arrURL[2] != '') {
        for($i = 2; $i < count($arrURL); $i++) {
            $params .= $arrURL[$i] . ',';
        }
        $params = trim($params, ',');
    }
}

require_once "Libraries/Core/Autoload.php";
require_once "Libraries/Core/Load.php";