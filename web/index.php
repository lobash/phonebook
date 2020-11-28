<?php
session_start();

include_once '../vendor/autoload.php';

include_once ('../configs/constants.php');

$oController = new controllers\Controller();
echo $oController->route();
exit;