<?php
namespace App\Frontend;

use \OCFram\Application;
use OCFram\DataCache;
use OCFram\CacheManager;

class FrontendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();

    $this->name = 'Frontend';
  }

  public function run()
  {
    $controller = $this->getController();
    $controller->execute();

    $cacheName = $this->name . '_' . $controller->module() . '_' . $controller->view();
    $cacheManager = new CacheManager('views');

    // Si la vue est déjà en cache
    $viewCache = $cacheManager->load($cacheName);
    if ($viewCache  !== null) {
        $view = $viewCache->getData();

    } else {
        // Récupération de la vue
        $controller->execute();
        $view = $controller->page()->getGeneratedPage();

        // Mise en cache de la vue avec une validité de 10 minutes
        $expirationDate = new \DateTime;
        $viewCache = new DataCache($cacheName, $view, $expirationDate->add(new \DateInterval('PT10M')));
        $cacheManager->save($viewCache);
    }


    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send($view);
  }
}
