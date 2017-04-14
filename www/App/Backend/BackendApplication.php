<?php
namespace App\Backend;
use OCFram\Application;

/**
 *
 */
class BackendApplication extends Application
{

    function __construct()
    {
        parent::__construct('Backend');
    }

    public function run()
    {
        if ($this->user->isAuthenticated()) {
            $controller = $this->getController();
        } else {
            $controller = new \App\Backend\Modules\Connection\ConnectionController($this, 'Connection', 'index');
        }
        $controller->execute();
        $this->httpResponse->setPage($controller->getPage());
        $this->httpResponse->send();
    }
}
