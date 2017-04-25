<?php
namespace OCFram;
use \PDO;

/**
 *
 */
trait PDOManager
{
    public function __construct(PDO $dao)
    {
        $this->dao = $dao;
    }

    public function setDao(PDO $dao)
    {
        $this->dao = $dao;
    }

    public function getDao(): PDO
    {
        return $this->dao;
    }
}
