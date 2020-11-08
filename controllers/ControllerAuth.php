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

    public function actionShowRegisterForm()
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

    /**
     * при успешной регистрации редиректит на главную
     * @throws Exception
     */
    public function actionAdd()
    {
        Validator::checkCsrf();

        $aPost = $_POST;
        $aPost = Validator::clearArray($aPost);
        $oValidator = new Validator();

        $aResponse['error'] = '';

        if ($oValidator->checkValidPassword($aPost['password']) === true) {
            if (Users::isLoginUnique($aPost['login']) === true) {
                $iLastId = Users::addNew($aPost);
                if ($iLastId !== 0) {
                    CurrentUser::loggedIn($iLastId);

                } else {
                    $aResponse['error'] = 'Ошибка при сохранении';
                }

            } else {
                $aResponse['error'] = 'Такой логин уже существует';
            }

        } else {
            $aResponse['error'] = 'Не валидный пароль';
        }

        return json_encode($aResponse);
    }
}