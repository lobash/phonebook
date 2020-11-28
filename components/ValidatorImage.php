<?php

namespace components;

class ValidatorImage extends Validator
{


    /**
     * @param array $aFile часть массива _FILES[input_name]
     * @return bool
     */
    public function isCorrect(array $aFile): bool
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

}