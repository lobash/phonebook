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
    protected function actionAuth()
    {
        return 'auth';
    }

    /**
     * @return string
     */
    protected function actionRegister()
    {
        return 'register';
    }

    /**
     * @return string
     */
    protected function actionList()
    {
        return 'list';
    }

    /**
     * @return string
     */
    protected function actionIndex()
    {
        return 'index';
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

}