<?php
namespace OCFram;

/**
 * ManagersList contains a list of Manager object. Each Manager is linked to a module of an application.
 */
class ManagersList
{

    /**
     * Class of the the dao.
     * @var String
     */
    protected $api = null;
    /**
     * Data Access Object.
     * @var Object
     */
    protected $dao = null;
    /**
     * Array of managers.
     * @var array
     */
    protected $managers = [];

    function __construct(String $api, $dao)
    {
        $this->api = $api;
        $this->dao = $dao;
    }

    public function getManagerOf(String $module): Manager
    {
    if (!isset($this->managers[$module]))
        {
          $manager = '\\Model\\' . $module . 'Manager' . $this->api;
          $this->managers[$module] = new $manager($this->dao);
        }

    return $this->managers[$module];
    }
}
