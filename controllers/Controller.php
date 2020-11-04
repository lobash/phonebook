<?php

namespace controllers;

class Controller
{
    /** @var array */
    private $aRoutes = [];

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->aRoutes = require CONFIG_DIR_PATH . '/routes.php';
    }

    /**
     * @return void
     */
    public function route(): void
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
                $oController = new  $sControllerName();

                echo call_user_func_array([$oController, $sActionName], $aRouteData);
            }
        }
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

}