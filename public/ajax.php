<?php

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

define('CONST_INCLUDE', NULL);


require_once("../src/Service/DBConnection.php");
require_once("../src/Service/AuthService.php");
require_once("../src/Service/Request.php");

require_once("../src/Model/UserModel.php");
require_once("../src/Model/CityModel.php");
require_once("../src/Model/SexModel.php");

$entity = isset($_GET['entity'])?ucfirst(strtolower($_GET['entity'])).'Request':null;
$path = "../src/Request/". $entity.".php";

DBConnection::initConnexionDB();

if(file_exists($path)){
    include_once($path);
    $entityRequest = new $entity();
    $entityRequest->execute();
    $entityRequest->sendRequest();
}else{

}
    
?>