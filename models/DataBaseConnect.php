<?php


namespace models;

use PDO;
use PDOException;

class DataBaseConnect
{
	public static function getInstance()
    {
        $aConfig = include CONFIG_DIR_PATH . '/database.php';

        try {
            return new PDO(
                'mysql:host=' . $aConfig['host'] . ';dbname=' . $aConfig['name'],
                $aConfig['user'],
                $aConfig['password'],
                [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
            );
        } catch (PDOException $e) {
            die("db error: " . $e->getMessage() . "<br/>");
        }
    }


}
