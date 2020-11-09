<?php

namespace controllers;

use components\CurrentUser;
use components\Validator;
use Exception;
use models\Users;
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

        $aPost = Validator::clearArray($_POST);

        if (!empty($aPost['login']) || !empty($aPost['password'])) {
            $aResult['error'] = '';
            $iId = (int)Users::getIdOnLoginPassword($aPost['login'], $aPost['password']);

            if ($iId !== 0) {
                CurrentUser::loggedIn($iId);

            } else {
                $aResult['error'] = 'логин или пароль не совпадают';
            }

            return json_encode($aResult);
        }
        throw new Exception('incorrect data for login');
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