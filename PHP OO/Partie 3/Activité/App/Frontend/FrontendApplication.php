<?php
namespace App\Frontend;
use OCFram\Application;

/**
 *
 */
class FrontendApplication extends Application
{

    function __construct()
    {
        parent::__construct('Frontend');
    }

    public function run()
    {
        $controller = $this->getController();
        $controller->execute();
        $this->httpResponse->setPage($controller->getPage());
        $this->httpResponse->send();
    }
}
