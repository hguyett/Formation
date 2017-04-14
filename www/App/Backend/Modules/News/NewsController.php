<?php
namespace App\Backend\Modules\News;
use Entity\News;
use Model\NewsManager;
use OCFram\HTTPRequest;
use OCFram\BackController;

/**
 *
 */
class NewsController extends BackController
{

    public function executeIndex()
    {
        $this->page->addVar('title', 'Gestion des news');

        /**
         * @var NewsManager $manager
         */
        $manager = $this->managersList->getManagerOf('news');

        $this->page->addVar('newsList', $manager->getList());
    }

    public function executeInsert(HTTPRequest $httpRequest)
    {
        if ($httpRequest->postExists('title')) {
            $this->processForm($httpRequest);
        }

        $this->page->addVar('title', 'Ajouter une news');
    }

    public function executeUpdate(HTTPRequest $httpRequest)
    {

        if ($httpRequest->postExists('title')) {
            $this->processForm($httpRequest);
        } else {
            /**
             * @var NewsManager $manager
             */
            $manager = $this->managersList->getManagerOf('news');
            $news = $manager->get($httpRequest->getData('id'));
            $this->page->addVar('news', $news);
        }

        $this->page->addVar('title', 'Mettre à jour une news');
    }

    public function executeDelete(HTTPRequest $httpRequest)
    {
        /**
         * @var NewsManager $manager
         */
        $manager = $this->managersList->getManagerOf('news');
        if ($manager->delete($manager->get($httpRequest->getData('id')))) {
            $this->app->getUser()->setMessage('La news a bien été supprimée.');
        }
        $this->app->getHttpResponse()->redirect('.');
    }

    protected function processForm(HTTPRequest $httpRequest)
    {
        $news = new News(array(
            'author' => $httpRequest->postData('author'),
            'title' => $httpRequest->postData('title'),
            'content' => $httpRequest->postData('content')
        ));

        if ($httpRequest->getExists('id')) {
            $news->setId($httpRequest->getData('id'));
        }

        if ($news->isValid()) {
            /**
             * @var NewsManager $manager
             */
            $manager = $this->managersList->getManagerOf('news');
            if ($manager->save($news)) {
                $this->app->getUser()->setMessage('La news a bien été sauvegardée.');
            } else {
                $this->app->getUser()->setMessage('Une erreur est survenue.');
            }
        }
        $this->page->addVar('news', $news);
    }

}
