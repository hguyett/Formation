<?php
namespace OCFram;

class HTTPResponse extends ApplicationComponent
{
  protected $page;

  public function addHeader($header)
  {
    header($header);
  }

  public function redirect($location)
  {
    header('Location: '.$location);
    exit;
  }

  public function redirect404()
  {
    $this->page = new Page($this->app);

    $user = $this->app->user();

    ob_start();
      require __DIR__.'/../../Errors/404.html';
    $content = ob_get_clean();

    ob_start();
      require __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.php';
    $view = ob_get_clean();

    $this->addHeader('HTTP/1.0 404 Not Found');

    $this->send($view);
  }

  public function send(string $view)
  {
    // Actuellement, cette ligne a peu de sens dans votre esprit.
    // Promis, vous saurez vraiment ce qu'elle fait d'ici la fin du chapitre
    // (bien que je suis sûr que les noms choisis sont assez explicites !).
    exit($view);
  }

  public function setPage(Page $page)
  {
    $this->page = $page;
  }

  // Changement par rapport à la fonction setcookie() : le dernier argument est par défaut à true
  public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true)
  {
    setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
  }
}
