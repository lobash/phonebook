<?php

spl_autoload_register(function ($class_name) {
    include_once "controllers/$class_name.php";
});

$route = $_GET['route'] ?? '';
$matches = explode('/', $route);

$controller = $matches[0] ?? '';
$controller .= 'Controller';
$action = 'action';
$action .= ucfirst($matches[1] ?? 'index');


$oController = new $controller();
echo $oController->$action();