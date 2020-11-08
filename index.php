<?php

session_start();

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}
spl_autoload_register('autoload');
define('ROOT', dirname(__FILE__));
define('CONFIG_DIR', ROOT . '/configs');
define('IMAGE_DIR', ROOT . '/assets/images');
define('WEB_IMAGE_DIR', '/assets/images');

$oController = new controllers\Controller();
echo $oController->route();
exit;