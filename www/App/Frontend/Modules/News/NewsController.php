<?php
namespace App\Frontend\Modules\News;
use Entity\Comment;
use Model\CommentManager;
use OCFram\NotFoundException;
use Model\NewsManager;
use Entity\News;
use OCFram\ManagersList;
use OCFram\BackController;
use OCFram\HTTPRequest;

/**
 *
 */
class NewsController extends BackController
{

    public function executeIndex()
    {
        $numberOfNews = $this->app->getConfiguration()->getVar('news_number');
        $numberOfCharacters = $this->app->getConfiguration()->getVar('news_summary_characters_number');

        $this->page->addVar('title', 'Liste des ' . $numberOfNews . 'dernières news');

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
    }

    public function executeInsertComment(HTTPRequest $httpRequest)
    {
        $id = $httpRequest->getData('newsId');
        $this->page->addVar('NewsId', $id);

        if (isset($_POST['author']) and isset($_POST['content'])) {
            $manager = $this->managersList->getManagerOf("Comment");
            /**
            * @var CommentManager $manager
            */
            $comment = new Comment(array('author' => $_POST['author'], 'content' => $_POST['content']));
            $comment->setId($id);
            $manager->save($comment);
        }
    }

}
