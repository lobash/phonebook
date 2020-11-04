<?php

namespace models;

/**
 * Class Phone
 * @package models
 */
class Phone
{
    /**
     * @return array
     */
    public static function getList(): array
    {
        $oDb = DataBaseConnect::getInstance();
        $sQuery = "SELECT `id`, `first_name`, `last_name`, `phone_number`, `email`, `image_path` FROM phone LIMIT 0, 100";
        $result = $oDb->query($sQuery);
        $aList = [];
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $aList[] = $row;
        }

        return $aList;
    }
}