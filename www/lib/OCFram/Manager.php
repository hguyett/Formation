<?php
namespace OCFram;

/**
 *
 */
abstract class Manager
{

    /**
     * Data Access Object.
     */
    protected $dao;

    public function __construct($dao)
    {
        $this->dao = $dao;
    }
}
