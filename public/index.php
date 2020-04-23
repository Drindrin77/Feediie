<?php

ini_set('session.use_strict_mode',1);
session_start();

define('CONST_INCLUDE', NULL);
define('PATH_USER_PHOTO', '/Images/UserUpload/');
define('PATH_DISH_PHOTO', '/Images/Dish/');
define('PATH_ICON_PHOTO', '/Images/Icon/');
define('PATH_DEFAULT_USER_PHOTO', '/Images/UserUpload/default.png');
define('MAX_USER_PHOTO',10);

require_once("../src/Service/DBConnection.php");
require_once("../src/Service/AuthService.php");
require_once("../src/Service/PasswordService.php");
require_once("../src/Service/EmailService.php");
require_once("../src/Service/DateService.php");

require_once("../src/Controller/Controller.php");

require_once("../src/Model/UserModel.php");
require_once("../src/Model/CityModel.php");
require_once("../src/Model/SexModel.php");
require_once("../src/Model/DishModel.php");
require_once("../src/Model/HobbyModel.php");
require_once("../src/Model/PhotoModel.php");

require_once("../src/View/ViewModel.php");

DBConnection::initConnexionDB();
AuthService::setCurrentUser();

$urlWithoutParams = explode ('?', $_SERVER['REQUEST_URI']);
$routes = explode('/',$urlWithoutParams[0]);
$controllerName = ucfirst(strtolower($routes[1])). 'Controller';
$controllerPath = "../src/Controller/$controllerName.php";

if(empty($routes[1]) || file_exists($controllerPath)){
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