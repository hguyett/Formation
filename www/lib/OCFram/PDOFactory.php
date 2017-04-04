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
            'mysql:host=localhost;dbname=news',
            'root',
            '',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
}
