<?php
namespace App\Backend\Modules\News;
use Entity\News;
use Entity\Comment;
use FormBuilder\NewsFormBuilder;
use FormBuilder\CommentFormBuilder;
use Model\NewsManager;
use Model\CommentsManager;
use OCFram\FormHandler;
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
        $this->processForm($httpRequest);

        $this->page->addVar('title', 'Ajouter une news');
    }

    public function executeUpdate(HTTPRequest $httpRequest)
    {
        $this->processForm($httpRequest);

        $this->page->addVar('title', 'Mettre à jour une news');
    }

    public function executeDelete(HTTPRequest $httpRequest)
    {
        /**
         * @var NewsManager $manager
         */
        $manager = $this->managersList->getManagerOf('news');
        if ($manager->deleteById($httpRequest->getData('id'))) {
            $this->app->getUser()->setMessage('La news a bien été supprimée.');
        }
        $this->app->getHttpResponse()->redirect('.');
    }

    public function executeUpdateComment(HTTPRequest $httpRequest)
    {
        // If a comment has been submitted, loads it
        if ($httpRequest->method() == 'POST') {
            $comment = new Comment(array(
                'id' => $httpRequest->getData('id'),
                'author' => $httpRequest->postData('author'),
                'content' => $httpRequest->postData('content')
            ));
        } else {
            // Loads the comment
            $comment = $this->managersList->getManagerOf("Comments")->get($httpRequest->getData('id'));
        }
        /**
         * @var Comment $comment
         */

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();
        $form = $formBuilder->getForm();

        // If a comment has been submitted and is valid, save it
        if ($httpRequest->method() == 'POST') {
            $manager = $this->managersList->getManagerOf("Comments");
            $formHandler = new FormHandler($form, $manager, $httpRequest);
            if ($formHandler->process()) {
                $this->app->getUser()->setMessage('Le commentaire a bien été modifié.');
                $NewsId = $this->managersList->getManagerOf("Comments")->get($httpRequest->getData('id'))->getNews();
                $this->app->getHttpResponse()->redirect('/news-' . $NewsId . '.html');
            } elseif (!$form->isValid()) {
                // If a comment has been submitted but is not valid, return error messages
                $this->app->getUser()->setMessage($form->getErrorMessage());
            } else {
                $this->app->getUser()->setMessage('Une erreur est survenue lors de l\'enregistrement du commentaire dans la base de données.');
            }
        }

        $this->page->addVar('form', $form->createView());
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
        $news = new News;

        // If a news has been submitted
        if ($httpRequest->method() == 'POST') {
            $news->hydrate([
                'author' => $httpRequest->postData('author'),
                'title' => $httpRequest->postData('title'),
                'content' => $httpRequest->postData('content')
            ]);

            // If it's an existing news, loads its ID
            if ($httpRequest->getExists('id')) {
                $news->setId($httpRequest->getData('id'));
            }
        // If we're updating an existing news, loads the news
        } else {
            if ($httpRequest->getExists('id')) {
                // Loading the news
                $news = $this->managersList->getManagerOf("News")->get($httpRequest->getData('id'));
            }
        }

        // Creating the form
        $formBuilder = new NewsFormBuilder($news);
        $formBuilder->build();
        $form = $formBuilder->getForm();

        // If a news has been submitted and is valid, save it
        if ($httpRequest->method() == 'POST') {
            $manager = $this->managersList->getManagerOf("News");
            $formHandler = new FormHandler($form, $manager, $httpRequest);
            if ($formHandler->process()) {
                $this->app->getUser()->setMessage('La news a bien été enregistrée.');
                $this->app->getHttpResponse()->redirect('/admin/');
            } elseif (!$form->isValid()) {
                // If a news has been submitted but is not valid, return error messages
                $this->app->getUser()->setMessage($form->getErrorMessage());
            } else {
                $this->app->getUser()->setMessage('Un problème un survenu lors de l\'enregistrement de la news dans la base de données.');
            }
        }

        $this->page->addVar('form', $form->createView());
    }

}
