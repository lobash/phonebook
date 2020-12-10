<?php


namespace application;


use components\Validator;
use Exception;

class Request
{

    /**
     * @param string $sKey
     * @param string $sDefault
     * @return string
     * @throws Exception
     */
    public static function get(string $sKey, string $sDefault = '')
    {
        if (self::haveData($sKey) === false) {

            if ($sDefault !== '') {
                return $sDefault;
            }

            throw new Exception('have not key in POST message');
        }

        return Validator::clearString($_POST[$sKey]);
    }

    /**
     * @param string $sKey
     * @return bool
     */
    private static function haveData(string $sKey): bool
    {
        return empty($_POST[$sKey]) !== true;
    }


}