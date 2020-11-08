<?php

namespace controllers;

use views\View;

/**
 * Class ControllerPhone
 * @package controllers
 */
class ControllerAuth
{
    /**
     * @return string
     */
    public function actionIndex()
    {
    }

    public function actionLogin()
    {
    }

    public function actionRegister()
    {
    }


    public function actionLogout()
    {
    }

    /**
     * @return string
     */
    public function actionShowFormAuth(): string
    {
        $oView = new View('auth/auth_form');
        return $oView->render();
    }
}