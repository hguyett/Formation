<?php
namespace OCFram;

/**
 *
 */
class Route
{

    ////////////////
    // Properties //
    ////////////////

    /**
    * URL. Can be a string or a regular expression (if the route is used as a model).
    * @var String
    */
    protected $url;
    /**
    * Module requested.
    * @var String
    */
    protected $module;
    /**
     * Action to execute.
     * @var String
     */
    protected $action;
    /**
     * Names of variables.
     * @var array
     */
    protected $varsNames;
    /**
     * Variables and their values.
     * @var array
     */
    protected $vars;

    public function __construct(String $url, String $module, String $action, array $varsNames)
    {
        $this->setUrl($url)
        ->setModule($module)
        ->setAction($action)
        ->setVarsNames($varsNames);
    }

    /////////////
    // Methods //
    /////////////

    /**
     * Returns true if the route can contains variables.
     * @return bool
     */
    public function hasVars(): bool
    {
        return !empty($this->varsNames);
    }

    /**
     * Compares an url to the url of this route (considered as a regular expression) using preg_match. If it matches, the function return the result of the preg_match. Else, it returns false.
     * @param  String $url
     * @return mixed      return an array or false.
     */
    public function match(String $url)
    {
        if (preg_match('`^' . $this->url . '$`', $url, $matches))  {
            return $matches;
        } else {
            return false;
        }
    }

    /////////////
    // Setters //
    /////////////

    /**
     * @param String $url
     *
     * @return static
     */
    public function setUrl(String $url)
    {
        $this->url = $url;
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
     * @param array $varsNames
     *
     * @return static
     */
    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
        return $this;
    }

    /**
     * @param array $vars
     *
     * @return static
     */
    public function setVars(array $vars)
    {
        $this->vars = $vars;
        return $this;
    }

    /////////////
    // Getters //
    /////////////

    /**
     * @return String
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return String
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @return String
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getVarsNames()
    {
        return $this->varsNames;
    }

    /**
     * @return array
     */
    public function getVars()
    {
        return $this->vars;
    }
}
