<?php


class Controller
{
    /**
     * @return mixed
     */
    public function route()
    {
        $sUri = $this->getUrl();

        try {
            $action = 'action' . ucfirst(substr($sUri, 1));
            return $this->$action();

        } catch (Exception $exception) {
            throw new $exception;
        }
    }


    /**
     * @return string
     */
    public function actionAuth()
    {
        return 'auth';
    }

    /**
     * @return string
     */
    public function actionRegister()
    {
        return 'register';
    }

    /**
     * @return string
     */
    public function actionList()
    {
        return 'list';
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        if ($this->isAuth()) {
            return $this->actionList();
        }
        return $this->actionRegister();
    }

    /**
     * @return mixed|string
     */
    private function getUrl()
    {
        $sUri = $_SERVER['REQUEST_URI'];
        if ($sUri == '/') {
            $sUri = '/index';
        }
        return $sUri;
    }

    /**
     * @return bool
     */
    private function isAuth()
    {
        return false;
    }

}