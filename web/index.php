<?php
session_start();

include_once '../vendor/autoload.php';

include_once ('../configs/constants.php');

$oController = new application\Router();
echo $oController->run();
exit;