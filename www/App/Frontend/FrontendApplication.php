<?php
namespace App\Frontend;

use \OCFram\Application;
use \OCFram\CacheFile;
use \OCFram\CacheManager;

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

    $cacheName = $this->name . '_' . $controller->module() . '_' . $controller->view();
    $cacheManager = new CacheManager('views');

    // Si la vue est déjà en cache et que l'utilisateur n'est pas un administrateur, la vue est chargée en cache
    $viewCache = $cacheManager->load($cacheName);
    if ($viewCache  !== null and !$this->user()->isAuthenticated()) {
        $view = $viewCache->getData();

    // Sinon, la vue est générée
    } else {
        // Récupération de la vue
        $controller->execute();
        $view = $controller->page()->getGeneratedPage();

        // Mise en cache de la vue si l'utilisateur n'est pas administrateur (empêche la mise en cache d'une vue administrateur)
        if (!$this->user()->isAuthenticated()) {
            $viewCacheTime = null;
            foreach ($controller->getViewsCacheTime() as $viewName => $cacheTime) {
                if ($controller->view() == $viewName) {
                    $viewCacheTime = $cacheTime;
                    break;
                }
            }
        }

        if (isset($viewCacheTime)) {
            $expirationDate = new \DateTime;
            $viewCache = new CacheFile($cacheName, $view, $expirationDate->add(new \DateInterval($viewCacheTime)));
            $cacheManager->save($viewCache);
        }
    }


    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send($view);
  }
}
