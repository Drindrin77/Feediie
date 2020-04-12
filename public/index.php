<?php

if(session_status() == PHP_SESSION_NONE)
    session_start();

define('CONST_INCLUDE', NULL);

require_once("../src/Controller/Controller.php");
require_once("../src/Model/Model.php");
require_once("../src/ViewModel.php");
require_once("../src/Service/AuthService.php");
require_once("../src/Model/UserModel.php");

Model::initConnexionBD();

$urlWithoutParams = explode ('?', $_SERVER['REQUEST_URI']);
$routes = explode('/',$urlWithoutParams[0]);
$controllerName = ucfirst($routes[1]). 'Controller';
$controllerPath = "../src/Controller/$controllerName";

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
    $controller->execute($action); //ViewModel is set 
    $viewModel = $controller->getViewModel();
}
else{
    $viewModel = new ViewModel('Error404');
}
$viewModel->render();


?>