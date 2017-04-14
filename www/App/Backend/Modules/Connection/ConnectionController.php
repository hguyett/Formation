<?php
namespace App\Backend\Modules\Connection;
use OCFram\HTTPRequest;
use OCFram\BackController;

/**
 *
 */
class ConnectionController extends BackController
{

    public function executeIndex(HTTPRequest $httpRequest)
    {
        $this->page->addVar('title', 'Connexion');

        if ($httpRequest->postExists('login')) {
            if ($httpRequest->postData('login') == $this->app->getConfiguration()->getVar('login') and $httpRequest->postData('password') == $this->app->getConfiguration()->getVar('password')) {
                $this->app->getUser()->setAuthenticated(true);
                $this->app->getHttpResponse()->redirect('.');
            } else {
                $this->app->getUser()->setMessage('Le pseudo ou le mot de passe est incorrecte.');
            }
        }
    }

}
