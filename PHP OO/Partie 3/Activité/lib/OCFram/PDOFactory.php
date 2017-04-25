<?php
namespace OCFram;
use \PDO;

/**
 *
 */
class PDOFactory
{

    public function getMysqlConnexion(): PDO
    {
        return new PDO(
            'mysql:host=localhost;dbname=Frontend;charset=utf8',
            'root',
            '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
}
