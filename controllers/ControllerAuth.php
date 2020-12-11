<?php

namespace controllers;

use components\CurrentUser;
use components\Validator;
use Exception;
use services\Auth;
use views\View;

/**
 * Class ControllerPhone
 * @package controllers
 */
class ControllerAuth
{
    /**
     * @return string
     * @throws Exception
     */
    public function actionLogin(): string
    {
        Validator::checkCsrf();

        $aResult = Auth::loggedIn();
        return json_encode($aResult);
    }

    /**
     * @return string
     */
    public function actionShowRegisterForm(): string
    {
        $sCsrf = Validator::generateCsrf();

        $oView = new View('auth/register_form');
        $oView->assign('sCsrf', $sCsrf);
        return $oView->render();
    }

    /**
     * @return string
     */
    public function actionLogout(): string
    {
        CurrentUser::loggedOut();
        return json_encode('success');
    }

    /**
     * @return string
     */
    public function actionShowFormAuth(): string
    {
        $sCsrf = Validator::generateCsrf();

        $oView = new View('auth/auth_form');
        $oView->assign('sCsrf', $sCsrf);
        return $oView->render();
    }

    /**
     * при успешной регистрации редиректит на главную
     * @throws Exception
     */
    public function actionAdd()
    {
        Validator::checkCsrf();
        $aResponse['error'] = '';

        try {
            Auth::add();

        } catch (Exception $oException) {
            $aResponse['error'] = $oException->getMessage();
        }

        return json_encode($aResponse);
    }
}