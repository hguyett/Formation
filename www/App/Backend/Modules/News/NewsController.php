<?php
namespace App\Backend\Modules\News;
use Entity\News;
use Entity\Comment;
use Model\NewsManager;
use Model\CommentsManager;
use OCFram\HTTPRequest;
use OCFram\BackController;
use OCFram\NotFoundException;

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

    public function executeUpdateComment(HTTPRequest $httpRequest)
    {
        /**
        * @var CommentsManager $manager
        */
        $manager = $this->managersList->getManagerOf("Comments");
        if ($httpRequest->postExists('author')) {
            // Update Comment and redirect to the News.
            $comment = new Comment(array(
                'id' => $httpRequest->getData('id'),
                'news' => $httpRequest->postData('news'),
                'author' => $httpRequest->postData('author'),
                'content' => $httpRequest->postData('content')
            ));

            $manager->save($comment);

            $this->app->getHttpResponse()->redirect('../news-' . $comment->getNews() . '.html');

        } else {
            $id = $httpRequest->getData('id');
            try {
                $comment = $manager->get($id);
                $this->page->addVar('comment', $comment);
            } catch (NotFoundException $e) {
                $this->app->getHttpResponse()->redirect404();
            }

            $this->page->addVar('title', 'Modification d\'un commentaire');
        }
    }

    public function executeDeleteComment(HTTPRequest $httpRequest)
    {
        /**
         * @var CommentsManager $manager
         */
        $manager = $this->managersList->getManagerOf("Comments");
        /**
         * @var Comment $comment
         */
        $comment = $manager->get($httpRequest->getData('id'));
        if ($manager->delete($comment)) {
            $this->app->getUser()->setMessage('Le commentaire a bien été supprimé.');
        } else {
            $this->app->getUser()->setMessage('Une erreur est survenue.');
        }

        $this->app->getHttpResponse()->redirect('../news-' . $comment->getNews() . '.html');
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
