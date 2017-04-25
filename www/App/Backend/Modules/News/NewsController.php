<?php
namespace App\Backend\Modules\News;
use Entity\News;
use Entity\Comment;
use FormBuilder\NewsFormBuilder;
use FormBuilder\CommentFormBuilder;
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
        /**
        * @var CommentsManager $manager
        */
        /*$manager = $this->managersList->getManagerOf("Comments");
        if ($httpRequest->postExists('author')) {*/
            // Update Comment and redirect to the News.
            /*$comment = new Comment(array(
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
        }*/

        // If a comment has been submitted
        if ($httpRequest->method() == 'POST') {
            $comment = new Comment(array(
                'id' => $httpRequest->getData('id'),
                'author' => $httpRequest->postData('author'),
                'content' => $httpRequest->postData('content')
            ));
        } else {
            $comment = $this->managersList->getManagerOf("Comments")->get($httpRequest->getData('id'));
        }
        /**
         * @var Comment $comment
         */

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();
        $form = $formBuilder->getForm();

        if ($httpRequest->method() == 'POST' and $form->isValid()) {
            if ($this->managersList->getManagerOf("Comments")->save($comment)) {
                $this->app->getUser()->setMessage('Le commentaire a bien été modifié.');
                $NewsId = $this->managersList->getManagerOf("Comments")->get($httpRequest->getData('id'))->getNews();
                $this->app->getHttpResponse()->redirect('/news-' . $NewsId . '.html');
            } else {
                $this->app->getUser()->setMessage('Une erreur est survenue lors de la mise à jour du commentaire');
            }
        } elseif ($httpRequest->method() == 'POST') {
            $message = '';
            foreach ($form->getFields() as $formField) {
                /**
                 * @var Field $formField
                 */
                foreach ($formField->getErrorMessages() as $errorMessage) {
                    $message .= PHP_EOL . $errorMessage . '<br>';
                }
            }
            $this->app->getUser()->setMessage($message);
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
        /*$news = new News(array(
            'author' => $httpRequest->postData('author'),
            'title' => $httpRequest->postData('title'),
            'content' => $httpRequest->postData('content')
        ));

        if ($httpRequest->getExists('id')) {
            $news->setId($httpRequest->getData('id'));
        }

        if ($news->isValid()) {*/
            /**
             * @var NewsManager $manager
             */
            //$manager = $this->managersList->getManagerOf('news');
            /*if ($manager->save($news)) {
                $this->app->getUser()->setMessage('La news a bien été sauvegardée.');
            } else {
                $this->app->getUser()->setMessage('Une erreur est survenue.');
            }
        }
        $this->page->addVar('news', $news);*/

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
        if ($httpRequest->method() == 'POST' and $form->isValid()) {
            if ($news = $this->managersList->getManagerOf("News")->save($news)) {
                $this->app->getUser()->setMessage('La news a bien été enregistrée.');
                $this->app->getHttpResponse()->redirect('/admin/');
            } else {
                $this->app->getUser()->setMessage('Un problème un survenu lors de l\'enregistrement de la news.');
            }
        // If a news has been submitted but is not valid, return error messages
        } elseif ($httpRequest->method() == 'POST') {
            $message = '';
            foreach ($form->getFields() as $formField) {
                /**
                 * @var Field $formField
                 */
                foreach ($formField->getErrorMessages() as $errorMessage) {
                    $message .= PHP_EOL . $errorMessage . '<br>';
                }
            }
            $this->app->getUser()->setMessage($message);
        }

        $this->page->addVar('form', $form->createView());
    }

}
