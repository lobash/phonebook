<?php

namespace services;

use components\Validator;
use Exception;
use models\Phone as ModelPhone;

class Phone
{

    /**
     * @param $aData
     * @return int
     * @throws Exception
     */
    public static function add(array $aData): int
    {
        $aData = Validator::clearArray($aData);

        $iLastId = (int)ModelPhone::addNew($aData);
        if ($iLastId === 0) {
            throw new Exception('error with add new phone');
        }

        return $iLastId;
    }

    /**
     * @param int $iId
     * @return array
     * @throws Exception
     */
    public static function get(int $iId)
    {
        $iId = (int)Validator::clearString($iId);
        return ModelPhone::getOnId($iId);
    }

}