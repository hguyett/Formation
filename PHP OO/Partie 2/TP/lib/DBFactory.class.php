<?php
class DBFactory
{
    /**
     * Return PDO connection to MySQL database.
     * @return PDONewsManager
     */
    public static function getMysqlConnectionWithPDO(): PDONewsManager
    {
        try {
            $PDO = new PDO('mysql:host=localhost;dbname=news;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            die('Error : [' . $e->getCode() . '] ' . $e->getMessage());
        }
        $database = new PDONewsManager($PDO);
        return $database;
    }
}
