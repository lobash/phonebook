<?php

spl_autoload_register(function ($class_name){
   include_once "controllers/$class_name.php";
});

$oController = new Controller();
echo $oController->route();
