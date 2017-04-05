<?php
namespace App\Frontend;
use OCFram\Application;

/**
 *
 */
class FrontendApplication extends Application
{

    function __construct(User $user)
    {
        parent::__construct($this, $user);
    }

    public function run()
    {
        $controller = $this->getController();
        $controller->execute();
        $this->httpResponse->setPage($controller->getPage());
        $this->httpResponse->send();
    }
}
