<?php

if(session_status() == PHP_SESSION_NONE)
    session_start();

define('CONST_INCLUDE', NULL);

require_once("../src/Controller/Controller.php");
require_once("../src/Model/Model.php");
require_once("../src/ViewModel.php");

Model::initConnexionBD();

$urlWithoutParams = explode ('?', $_SERVER['REQUEST_URI']);
$routes = explode('/',$urlWithoutParams[0]);
$controllerName = ucfirst($routes[1]). 'Controller';
$controllerPath = "../src/Controller/$controllerName.php";

//URL : "/" TODO CONNECTED OR NOT CONNECTED USER
if(empty($routes[1])){
    $viewModel = new ViewModel('Error404');
}

else if(file_exists($controllerPath)){
    include_once "src/Controller/". $controllerName;
    $controller = new $controllerName();
    $action = $routes[2];
    $viewModel = $controller->execute($action);
    $viewModel->render();
}
else{
    $viewModel = new ViewModel('Error404');
}

$viewModel->render();

?>