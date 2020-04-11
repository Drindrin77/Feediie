<?php

session_start();

require_once("src/Controller/Controller.php");
require_once("src/Model/Model.php");

Model::initConnexionBD();

$urlWithoutParams = explode ('?', $_SERVER['REQUEST_URI']);
$routes = explode('/',$urlWithoutParams[0]);
$controllerName = ucfirst($routes[0]). 'Controller';

if(file_exists($controllerPath)){
    include_once "src/Controller/". $controllerName;
    $controller = new $controllerName();
    $action = $routes[1];
    $viewModel = $controller->execute($action);
    $viewModel->render();
}else{
    //Renvoie page 404
}

?>