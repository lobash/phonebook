<?php


class Controller
{
    /** @var array */
    private $aRoutes = [];

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->aRoutes = include ROOT . '/configs/routes.php';
    }

    /**
     * @return string
     */
    public function route(): string
    {
        $sUri = $this->getUrl();

        foreach ($this->aRoutes as $sPattern => $sPath) {
            if (preg_match("-$sPattern-", $sUri)) {
                list($sController, $sAction) = explode('/', $sPath);
                $sActionName = 'action' . ucfirst($sAction);
                $sControllerName = 'Controller' . ucfirst($sController);
                $oController = new $sControllerName;
                return $oController->$sActionName();
            }
        }
        return '';
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