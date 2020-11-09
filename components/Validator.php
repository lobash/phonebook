<?php

namespace components;

use Exception;

class Validator
{
    /** @var array */
    protected $aRules = [];

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        $this->aRules = include CONFIG_DIR . '/rules.php';
    }


    /**
     * @param string $sString
     * @return string
     */
    public static function clearString(string $sString): string
    {
        $sString = trim($sString);
        $sString = stripslashes($sString);
        $sString = strip_tags($sString);
        return htmlspecialchars($sString);
    }

    /**
     * @param array $aData
     * @return array
     */
    public static function clearArray(array $aData): array
    {
        foreach ($aData as &$sString) {
            $sString = static::clearString($sString);
        }
        return $aData;
    }

    /**
     * @param int $iLength
     * @return string
     */
    public static function generateCsrf(int $iLength = 10): string
    {
        $sRand = time() . rand(1, 1000);
        $sHash = password_hash($sRand, PASSWORD_DEFAULT);
        return $_SESSION['csrf'] = substr($sHash, $iLength);
    }

    /**
     * @return string
     */
    public static function getCsrf()
    {
        if (empty($_SESSION['csrf']) !== false) {
            return static::generateCsrf();
        }
        return $_SESSION['csrf'];
    }


    /**
     * @return void
     * @throws Exception
     */
    public static function checkCsrf(): void
    {
        if (empty($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
            throw new Exception("hacker detected");
        }
    }

}