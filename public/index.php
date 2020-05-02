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

require_once("../src/Controller/Controller.php");
require_once("../src/View/ViewModel.php");

DBConnection::initConnexionDB();
AuthService::setCurrentUser();

$urlWithoutParams = explode ('?', $_SERVER['REQUEST_URI']);
$routes = explode('/',$urlWithoutParams[0]);
$controllerName = ucfirst(strtolower($routes[1])). 'Controller';
$controllerPath = "../src/Controller/$controllerName.php";

if($controllerName[1]=='AdminController' && !AuthService::isAdmin()){
    $viewModel = new ViewModel('Error404');
}
else if(empty($routes[1]) || file_exists($controllerPath)){
    //URL : "/" 
    if(empty($routes[1])){
        if(AuthService::isAuthenticated()){
            $controllerName = "SwipeController";
        }else{
            $controllerName = "ConnectionController";
        }
    }
    include_once "../src/Controller/". $controllerName . ".php";
    $controller = new $controllerName();
    if(!empty($routes[2])){
        $action = strtolower($routes[2]);
    }
    else{
        $action = null;
    }
    $viewModel = $controller->execute($action); //return ViewModel 
}
else{
    $viewModel = new ViewModel('Error404');
}
$viewModel->render();
?>