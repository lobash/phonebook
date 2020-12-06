<?php

namespace application;

use views\View;

class Router
{
    /** @var array */
    private $aRoutes = [];

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->aRoutes = require CONFIG_DIR . '/routes.php';
    }

    /**
     * @return string
     */
    public function run(): string
    {
        $sUri = $this->getUrl();
        foreach ($this->aRoutes as $sPattern => $sPath) {
            if (preg_match("-$sPattern-", $sUri)) {
                $internalRoute = preg_replace("-$sPattern-", $sPath, $sUri);
                $aRouteData = explode('/', $internalRoute);
                $sController = array_shift($aRouteData);
                $sAction = array_shift($aRouteData);
                $sActionName = 'action' . ucfirst($sAction);
                $sControllerName = 'controllers\\' . 'Controller' . ucfirst($sController);
                $oController = new $sControllerName();

                if (class_exists($sControllerName) === false || method_exists($oController, $sActionName) === false) {
                    return $this->set404();
                }

                return (string)call_user_func_array([$oController, $sActionName], $aRouteData);
            }
        }
        return $this->set404();
    }

    /**
     * @return string
     */
    private function getUrl(): string
    {
        $sUri = '';
        if (!empty($_SERVER['REQUEST_URI'])) {
            $sUri = trim($_SERVER['REQUEST_URI'], '/');
        }
        return $sUri;
    }

    /**
     * @return string
     */
    private function set404(): string
    {
        $oView = new View('404');
        return $oView->render();
    }

}