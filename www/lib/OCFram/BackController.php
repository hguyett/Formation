<?php
namespace OCFram;
use RuntimeException;
/**
 *
 */
abstract class BackController extends ApplicationComponent
{

    ////////////////
    // Properties //
    ////////////////


    /**
     * Action that the controller must execute.
     * @var String
     */
    protected $action;
    /**
     * Module to which the controller belongs to.
     * @var String
     */
    protected $module;
    /**
     * Page used by the controller to print the result.
     * @var Page
     */
    protected $page;
    /**
     * View
     * @var String
     */
    protected $view;

    /**
     * List of managers handled by the controller.
     * @var ManagersList
     */
    protected $managersList;

    /////////////
    // Methods //
    /////////////


    function __construct(Application $app, String $module = '', String $action)
    {
        parent::__construct($app);

        $PDO = new PDOFactory();

        $this->managersList = new ManagersList('PDO', $PDO->getMysqlConnexion());
        $this->page = new Page($app);

        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);

    }

    /**
     * Execute an action of the module.
     * @throws RuntimeException Throw a RuntimeException if the action is not defined in the module.
     */
    public function execute()
    {
        $method = 'execute' . ucfirst($this->action);
        if (is_callable('App\\' . $this->app->getName() . '\\Modules\\' . $this->module . '\\' . $this->module . 'Controller' . '::' . $method)) {
            $this->$method($this->app->getHttpRequest());
        } else {
            throw new RuntimeException('Action ' . $this->action . ' is not defined on this module.');
        }
    }

    /////////////
    // Setters //
    /////////////


    /**
     * @param String $action
     *
     * @return static
     */
    public function setAction(String $action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param String $module
     *
     * @return static
     */
    public function setModule(String $module)
    {
        $this->module = $module;
        return $this;
    }

    /**
     * @param String $view
     *
     * @return static
     */
    public function setView(String $view)
    {
        $this->view = $view;
        $this->page->setContentFile(realpath(__DIR__.'/../../App/'.$this->app->getName().'/Modules/'.$this->module.'/Views/'.$this->view.'.php'));
        return $this;
    }

    /////////////
    // Getters //
    /////////////


    /**
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }
}
