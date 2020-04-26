<?php

ini_set('session.use_strict_mode',1);
session_start();

define('CONST_INCLUDE', NULL);
define('PATH_USER_PHOTO', '/Images/UserUpload/');

require_once("../src/Service/DBConnection.php");
require_once("../src/Service/AuthService.php");
require_once("../src/Service/RequestService.php");
require_once("../src/Service/PasswordService.php");
require_once("../src/Service/EmailService.php");
require_once("../src/Service/DateService.php");

require_once("../src/Model/UserModel.php");
require_once("../src/Model/CityModel.php");
require_once("../src/Model/SexModel.php");
require_once("../src/Model/DishModel.php");
require_once("../src/Model/DietModel.php");
require_once("../src/Model/HobbyModel.php");
require_once("../src/Model/PhotoModel.php");
require_once("../src/Model/ParameterModel.php");

$entity = isset($_GET['entity'])?ucfirst(strtolower($_GET['entity'])).'Request':null;
$action = isset($_GET['action'])?strtolower($_GET['action']):null;

$path = "../src/Request/". $entity.".php";

DBConnection::initConnexionDB();
AuthService::setCurrentUser();

if(file_exists($path)){
    include_once($path);
    $entityRequest = new $entity();
    $entityRequest->execute($action);
    $entityRequest->sendRequest();
}else{
    header("HTTP/1.0 404 Not Found");
    exit();
}
    
?>