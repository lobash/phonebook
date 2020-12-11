<?php


namespace services;


use application\Request;
use components\CurrentUser;
use components\ValidatorPassword;
use Exception;
use models\Users;

class Auth
{

    /**
     * @return array
     * @throws Exception
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

    /**
     * @return void
     * @throws Exception
     */
    public static function add(): void
    {
        self::checkPassword();
        self::checkLogin();
        $iLastId = self::addUser();
        CurrentUser::loggedIn($iLastId);
    }

    /**
     * @return void
     * @throws Exception
     */
    private static function checkPassword(): void
    {
        $oValidatorPwd = new ValidatorPassword();
        $sPassword = Request::get('password');
        if ($oValidatorPwd->isValid($sPassword) === false) {
            throw new Exception("Password is not valid");
        }

    }

    /**
     * @return void
     * @throws Exception
     */
    private static function checkLogin(): void
    {
        $sLogin = Request::get('login');
        if (Users::isLoginUnique($sLogin) === false) {
            throw new Exception("Duplicate login");
        }
    }

    /**
     * @throws Exception
     */
    private static function addUser(): int
    {
        $sLogin = Request::get('login');
        $sPassword = Request::get('password');
        $sEmail = Request::get('email');
        $iLastId = Users::addNew($sLogin, $sEmail, $sPassword);
        if ($iLastId === 0) {
            throw new Exception("Error with create user");
        }
        return $iLastId;
    }
}