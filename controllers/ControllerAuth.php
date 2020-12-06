<?php

namespace controllers;

use components\CurrentUser;
use components\Validator;
use components\ValidatorPassword;
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
        $oValidatorPwd = new ValidatorPassword();

        $aResponse['error'] = '';

        if ($oValidatorPwd->isValid($aPost['password']) === false) {
            $aResponse['error'] = 'Не валидный пароль';
        }

        if (Users::isLoginUnique($aPost['login']) === false) {
            $aResponse['error'] = 'Такой логин уже существует';
        }

        $iLastId = Users::addNew($aPost);
        if ($iLastId === 0) {
            $aResponse['error'] = 'Ошибка при сохранении';
        }

        CurrentUser::loggedIn($iLastId);

        return json_encode($aResponse);
    }
}