<?php
namespace OCFram;

/**
 *
 */
abstract class Manager
{

    /**
     * @var object
     */
    protected $dao;

    public function __construct(object $dao)
    {
        $this->dao = $dao;
    }
}
