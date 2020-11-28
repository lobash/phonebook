<?php

namespace models;

use components\CurrentUser;
use Exception;
use PDO;

/**
 * Class Phone
 * @package models
 */
class Phone
{
    /**
     * @param int $iUserId
     * @return array
     */
    public static function getListOnUserId(int $iUserId): array
    {
        $oDb = DataBaseConnect::getInstance();
        $sQuery = "SELECT `id`, `first_name`, `last_name`, `phone_number`, `email`, `image` FROM `phone`  WHERE `user_id` = :user_id ORDER BY `last_name`";
        $pdoStmt = $oDb->prepare($sQuery);
        $pdoStmt->execute([':user_id' => $iUserId]);

        $aList = [];
        while ($row = $pdoStmt->fetch(PDO::FETCH_ASSOC)) {
            $aList[] = $row;
        }

        return $aList;
    }

    /**
     * @param array $aData
     * @return string last insert id
     */
    public static function addNew(array $aData): string
    {
        $oDb = DataBaseConnect::getInstance();
        $sQuery = "INSERT INTO `phone` (`first_name`, `last_name`, `phone_number`, `email`, `image`, `user_id`) VALUES (:first_name, :last_name, :phone_number, :email, :image, :user_id);";
        $pdoStmt = $oDb->prepare($sQuery);
        $aBind = [
            ':first_name' => $aData['first_name'],
            ':last_name' => $aData['last_name'],
            ':phone_number' => $aData['phone_number'],
            ':email' => $aData['email'],
            ':image' => $aData['image'],
            ':user_id' => $aData['user_id']
        ];

        $pdoStmt->execute($aBind);
        return $oDb->lastInsertId();
    }

    /**
     * @param int $iId
     * @return bool
     * @throws Exception
     */
    public static function delete(int $iId): bool
    {
        $oDb = DataBaseConnect::getInstance();
        $sImage = self::getImageName($oDb, $iId);
        if (self::executeDelete($oDb, $iId) === false) {
            throw new Exception('Phone not deleted');
        }

        return self::deleteImage($sImage);
    }

    /**
     * @param PDO $oDb
     * @param int $iId
     * @return string
     */
    private static function getImageName(PDO &$oDb, int $iId): string
    {
        $sQueryImage = "SELECT `image` FROM `phone` WHERE `phone`.`id` = :id";
        $pdoStmt = $oDb->prepare($sQueryImage);
        $pdoStmt->bindParam(':id', $iId);
        $pdoStmt->execute();
        $aImage = $pdoStmt->fetchAll();
        $sName = '';
        if (empty($aImage[0]['image']) === false) {
            $sName = $aImage[0]['image'];
        }
        return $sName;
    }

    /**
     * @param int $iId
     * @return array
     * @throws Exception
     */
    public static function getOnId(int $iId): array
    {
        $oDb = DataBaseConnect::getInstance();
        $sQuery = "SELECT `first_name`, `last_name`, `phone_number`, `email`, `image` FROM `phone` WHERE `phone`.`id` = :id";
        $pdoStmt = $oDb->prepare($sQuery);
        $pdoStmt->bindParam(':id', $iId);
        $pdoStmt->execute();
        $aData = $pdoStmt->fetchAll();
        if (!empty($aData[0])) {
            return $aData[0];
        }
        throw new Exception("phone not found");
    }

    /**
     * @param PDO $oDb
     * @param int $iId
     * @return bool
     */
    private static function executeDelete(PDO &$oDb, int $iId): bool
    {
        $sQueryDelete = "DELETE FROM `phone` WHERE `phone`.`id` = :id AND `phone`.`user_id` = :user_id";
        $pdoStmt = $oDb->prepare($sQueryDelete);
        $pdoStmt->bindParam(':id', $iId);
        $pdoStmt->bindParam(':user_id', CurrentUser::getId());
        return $pdoStmt->execute();
    }

    /**
     * @param string $sImage
     * @throws Exception
     * @return bool
     */
    private static function deleteImage(string $sImage): bool
    {
        if ($sImage !== '') {
            if (unlink(IMAGE_DIR . '/' . $sImage) === false) {
                throw new Exception("Error with delete image");
            }
        }
        return true;
    }
}