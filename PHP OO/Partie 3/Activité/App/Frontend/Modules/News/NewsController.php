<?php
namespace App\Frontend\Modules\News;
use FormBuilder\CommentFormBuilder;
use OCFram\FormHandler;
use OCFram\Field;
use OCFram\Hydrator;
use OCFram\BackController;
use OCFram\ManagersList;
use OCFram\HTTPRequest;
use OCFram\NotFoundException;
use Model\NewsManager;
use Model\CommentsManager;
use Entity\News;
use Entity\Comment;

/**
 *
 */
class NewsController extends BackController
{

    public function executeIndex()
    {
        $numberOfNews = $this->app->getConfiguration()->getVar('news_number');
        $numberOfCharacters = $this->app->getConfiguration()->getVar('news_summary_characters_number');

        $this->page->addVar('title', 'Liste des ' . $numberOfNews . ' dernières news');

        $manager = $this->managersList->getManagerOf('News');

        /**
         * @var NewsManager $manager
         */
        $newsList = $manager->getList($numberOfNews);
        foreach ($newsList as $news) {
            /**
             * @var News $news
             */
            if (strlen($news->getContent()) > $numberOfCharacters) {
                $summary = substr($news->getContent(), 0, $numberOfCharacters);
                // Find the last space, cut the and replace it by suspension points.
                $summary = substr($summary, 0, strrpos($summary, ' ')) . '...';

                $news->setContent($summary);
            }
        }

    $this->page->addVar('newsList', $newsList);
    }

    public function executeShow(HTTPRequest $httpRequest)
    {
        $id = $httpRequest->getData('id');
        $manager = $this->managersList->getManagerOf('News');

        /**
         * @var NewsManager $manager
         */
        try {
            $news = $manager->get($id);
        } catch (NotFoundException $e) {
            $this->app->getHttpResponse()->redirect404();
        }

        $this->page->addVar('news', $news);
        $this->page->addVar('comments', $this->managersList->getManagerOf('Comments')->getNewsComments($news));
    }

    public function executeInsertComment(HTTPRequest $httpRequest)
    {
        $comment = new Comment;
        // If a comment has been submitted, loads it
        if ($httpRequest->method() == 'POST') {
            $newsId = $httpRequest->getData('newsId');
            $comment->hydrate(array(
                'news' => $newsId,
                'author' => $httpRequest->postData('author'),
                'content' => $httpRequest->postData('content')));
        }

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();

        $form = $formBuilder->getForm();

        // If a comment has been submitted and is valid, save it
        if ($httpRequest->method() == 'POST') {
            /**
            * @var CommentsManager $manager
            */
            $manager = $this->managersList->getManagerOf("Comments");
            $formHandler = new FormHandler($form, $manager, $httpRequest);
            if ($formHandler->process()) {
                $this->app->getUser()->setMessage('Votre commentaire a bien été ajouté.');
                $this->app->getHttpResponse()->redirect('news-' . $newsId . '.html');
            } elseif (!$form->isValid()) {
                // If a comment has been submitted but is not valid, return error messages
                $this->app->getUser()->setMessage($form->getErrorMessage());
            } else {
                $this->app->getUser()->setMessage('Une erreur est survenue lors de l\'ajout de votre commentaire dans la base de données.');
            }
        }

    $this->page->addVar('comment', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');
    }

}
