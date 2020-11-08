<?php


namespace components;


use Exception;

class Uploader
{

    /**
     * @param string $sName
     * @return string
     */
    private static function generateName(string $sName): string
    {
        $sFileExtension = self::getExtension($sName);
        return md5(time() . $sName) . '.' . $sFileExtension;
    }

    /**
     * @param string $sName
     * @return string
     */
    private static function getExtension(string $sName): string
    {
        $aNameParts = explode(".", $sName);
        return strtolower(end($aNameParts));
    }

    /**
     * Добавляет файл переданный с формы
     * @param $aFile
     * @return string
     * @throws Exception
     */
    public static function uploadFileImage(array $aFile): string
    {
        $oValidator = new Validator();
        if ($oValidator->issetCorrectImage($aFile)) {
            $sNewName = self::generateName($aFile['name']);

            if ($oValidator->checkSize($aFile['tmp_name']) === false) {
                throw new Exception("File size too large");
            }

            if ($oValidator->checkMimeType($aFile['tmp_name']) === false) {
                throw new Exception("Mime type is not correct");
            }

            $fileExtension = self::getExtension($aFile['name']);
            if ($oValidator->checkExtension($fileExtension) === false) {
                throw new Exception("Extension is not correct");
            }

            $sDestPath = IMAGE_DIR . '/' . $sNewName;

            if (move_uploaded_file($aFile['tmp_name'], $sDestPath) === false) {
                throw new Exception('File not downloaded');
            }

            return $sNewName;
        }

        throw new Exception('File not founded');
    }
}