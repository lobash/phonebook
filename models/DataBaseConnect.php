<?php


namespace models;

use PDO;
use PDOException;

class DataBaseConnect
{
    /**
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        $aConfig = include CONFIG_DIR . '/database.php';

        try {
            return new PDO(
                'mysql:host=' . $aConfig['host'] . ';dbname=' . $aConfig['name'],
                $aConfig['user'],
                $aConfig['password'],
                [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
            );
        } catch (PDOException $e) {
            die("db error: " . $e->getMessage());
        }
    }


}
