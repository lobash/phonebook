<?php


namespace services;


use application\Request;
use components\CurrentUser;
use models\Users;

class Auth
{

    /**
     * @return array
     * @throws \Exception
     */
    public static function loggedIn(): array
    {
        $sLogin = Request::get('login');
        $sPassword = Request::get('password');

        $aResult['error'] = '';
        $iId = (int)Users::getIdOnLoginPassword($sLogin, $sPassword);

        if ($iId === 0) {
            $aResult['error'] = 'логин или пароль не совпадают';
        }

        CurrentUser::loggedIn($iId);

        return $aResult;
    }
}