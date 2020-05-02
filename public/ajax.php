<?php

ini_set('session.use_strict_mode',1);
session_start();

define('CONST_INCLUDE', NULL);
define('PATH_USER_PHOTO', '/Images/UserUpload/');
define('PATH_DISH_PHOTO', '/Images/Dish/');
define('PATH_RELATION_PHOTO', '/Images/Relation/');
define('PATH_PERSONALITY_PHOTO', '/Images/Personality/');
define('PATH_ICON_PHOTO', '/Images/Icon/');
define('PATH_DEFAULT_USER_PHOTO', '/Images/UserUpload/default.png');
define('MAX_USER_PHOTO',6);

$services = glob('../src/Service/*.php', GLOB_BRACE);
foreach($services as $file) {
  require_once($file);
}
$models = glob('../src/Model/*.php', GLOB_BRACE);
foreach($models as $file) {
  require_once($file);
}

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