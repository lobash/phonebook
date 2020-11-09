<?php

namespace components;



class ValidatorPassword extends Validator
{
    /**
     * @param string $sPassword
     * @return string
     */
    public static function generateHash(string $sPassword): string
    {
        return password_hash($sPassword, PASSWORD_ARGON2I);
    }


    /**
     * @param $sPassword
     * @param $sHash
     * @return bool
     */
    public static function verify($sPassword, $sHash): bool
    {
        return password_verify($sPassword, $sHash);
    }


    /**
     * @param $sPassword
     * @return bool
     */
    public function isValid($sPassword): bool
    {
        $aPatternList = $this->aRules['password']['patterns'];
        $iMinLength = $this->aRules['password']['min_length'];
        if (strlen($sPassword) < $iMinLength) {
            return false;
        }

        foreach ($aPatternList as $sPattern) {
            if (preg_match($sPattern, $sPassword) === 0) {
                return false;
            }
        }

        return true;
    }

}