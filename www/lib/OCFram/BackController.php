<?php
namespace OCFram;

abstract class BackController extends ApplicationComponent
{
  // Tableau contenant le nom des vues et le temps de mise en cache qui leurs sont associées. Ce temps sera passé au constructeur de DateInterval, la notation est basée sur la norme ISO 8601.
  const VIEWS_CACHE_TIME = [];

  protected $action = '';
  protected $module = '';
  protected $page = null;
  protected $view = '';
  protected $managers = null;

  public function __construct(Application $app, $module, $action)
  {
    parent::__construct($app);

    $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
    $this->page = new Page($app);

    $this->setModule($module);
    $this->setAction($action);
    $this->setView($action);
  }

  public function execute()
  {
    $method = 'execute'.ucfirst($this->action);

    if (!is_callable([$this, $method]))
    {
      throw new \RuntimeException('L\'action "'.$this->action.'" n\'est pas définie sur ce module');
    }

    $this->$method($this->app->httpRequest());
  }

  /**
   * Retourne un tableau le nom des vues et le temps de mise en cache qui leurs sont associées.
   * @return array ['view' => 'PT10M'] (ISO 8601)
   */
  public function getViewsCacheTime(): array
  {
      return static::VIEWS_CACHE_TIME;
  }

  public function page()
  {
    return $this->page;
  }

  public function setModule($module)
  {
    if (!is_string($module) || empty($module))
    {
      throw new \InvalidArgumentException('Le module doit être une chaine de caractères valide');
    }

    $this->module = $module;
  }

  public function setAction($action)
  {
    if (!is_string($action) || empty($action))
    {
      throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valide');
    }

    $this->action = $action;
  }

  public function setView($view)
  {
    if (!is_string($view) || empty($view))
    {
      throw new \InvalidArgumentException('La vue doit être une chaine de caractères valide');
    }

    $this->view = $view;

    $this->page->setContentFile(__DIR__.'/../../App/'.$this->app->name().'/Modules/'.$this->module.'/Views/'.$this->view.'.php');
  }

/**
 * @return String
 */
public function module()
{
    return $this->module;
}

/**
 * @return String
 */
public function view()
{
    return $this->view;
}
}
