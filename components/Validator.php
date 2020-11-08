<?php

namespace components;

use Exception;

class Validator
{

    private $aRules = [];

    public function __construct()
    {
        $this->aRules = include CONFIG_DIR . '/rules.php';
    }

    /**
     * @param string $sString
     * @return string
     */
    public static function clearValue(string $sString): string
    {
        $sString = trim($sString);
        $sString = stripslashes($sString);
        $sString = strip_tags($sString);
        return htmlspecialchars($sString);
    }

    /**
     * @param int $iLength
     * @return false|string
     */
    public static function generateCsrf(int $iLength = 10)
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
     * @param array $aFile часть массива _FILES[input_name]
     * @return bool
     */
    public function issetCorrectImage(array $aFile): bool
    {
        $bIssetMage = isset($aFile) && $aFile['error'] === UPLOAD_ERR_OK;
        if ($bIssetMage === true) {
            if (!empty($aFile['tmp_name'])) {
                $aImageData = getimagesize($aFile['tmp_name']);
                return $aImageData[0] > 0 && $aImageData[1] > 0;
            }
        }
        return false;
    }

    /**
     * @param string $sExtension
     * @return bool
     */
    public function checkExtension(string $sExtension): bool
    {
        return in_array($sExtension, $this->aRules['allowed_extensions']);
    }

    /**
     * Возвращает true в случае если размер файла не превышает 5мб
     * @param string $sFilePath
     * @return boolean
     */
    public function checkSize(string $sFilePath): bool
    {
        return filesize($sFilePath) <= $this->aRules['max_file_size'];
    }

    /**
     * @param string $sFilePath
     * @return bool
     */
    public function checkMimeType(string $sFilePath): bool
    {
        return in_array(mime_content_type($sFilePath), $this->aRules['allowed_mime_types']);
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