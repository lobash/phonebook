<?php

namespace models;

use components\Validator;
use components\ValidatorPassword;

class Users
{
    /**\
     * @param string $sLogin
     * @param string $sPassword
     * @return int
     */
    public static function getIdOnLoginPassword(string $sLogin, string $sPassword): int
    {
        $oDb = DataBaseConnect::getInstance();
        $sQuery = "SELECT `id`, `password` FROM `users` WHERE `users`.`login` = :login";
        $pdoStmt = $oDb->prepare($sQuery);
        $pdoStmt->bindParam(':login', $sLogin);
        $pdoStmt->execute();
        $aData = $pdoStmt->fetchAll();

        if (!empty($aUser = $aData[0])) {
            if (ValidatorPassword::verify($sPassword, $aUser['password']) !== false) {
                return (int)$aUser['id'];
            }
        }
        return 0;
    }

    /**
     * @param array $aData
     * @return int
     */
    public static function addNew(array $aData): int
    {
        $oDb = DataBaseConnect::getInstance();
        try {
            $sQuery = "INSERT INTO `users` (`login`, `email`, `password`) VALUES (:login, :email, :password);";
            $sPwdHash = ValidatorPassword::generateHash($aData['password']);
            $pdoStmt = $oDb->prepare($sQuery);
            $aBind = [
                ':login' => $aData['login'],
                ':email' => $aData['email'],
                ':password' => $sPwdHash,
            ];
            $pdoStmt->execute($aBind);
            return (int)$oDb->lastInsertId();
        } catch (\PDOException $e) {
            die($oDb->errorInfo());
        }
    }

    /**
     * @param string $sLogin
     * @return bool
     */
    public static function isLoginUnique(string $sLogin): bool
    {
        $oDb = DataBaseConnect::getInstance();
        $sQuery = "SELECT `login` FROM `users` WHERE `users`.`login` = :login";
        $pdoStmt = $oDb->prepare($sQuery);
        $pdoStmt->bindParam(':login', $sLogin);
        $pdoStmt->execute();
        if (!empty($pdoStmt->fetchAll())) {
            return false;
        }
        return true;
    }

}