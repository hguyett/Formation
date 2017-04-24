<?php
namespace App\Frontend\Modules\News;
use FormBuilder\CommentFormBuilder;
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
        /*$this->page->addVar('title', 'Ajouter un commentaire');
        if (isset($_POST['author']) and isset($_POST['content']) and ($httpRequest->getExists('newsId'))) {*/
            /**
            * @var CommentsManager $manager
            */
        /*    $manager = $this->managersList->getManagerOf("Comments");

            $newsId = $httpRequest->getData('newsId');
            $comment = new Comment(array(
                'news' => $newsId,
                'author' => $httpRequest->postData('author'),
                'content' => $httpRequest->postData('content')));

            $manager->save($comment);
            $this->app->getHttpResponse()->redirect('news-' . $newsId . '.html');
        }*/

        $comment = new Comment;
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

        if ($httpRequest->method() == 'POST' and $form->isValid()) {
            /**
            * @var CommentsManager $manager
            */
            $manager = $this->managersList->getManagerOf("Comments");
            if ($manager->save($comment)) {
                $this->app->getUser()->setMessage('Votre commentaire a bien été ajouté.');
                $this->app->getHttpResponse()->redirect('news-' . $newsId . '.html');
            } else {
                $this->app->getUser()->setMessage('Une erreur est survenue lors de l\'ajout de votre commentaire.');
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

    $this->page->addVar('comment', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');
    }

}
