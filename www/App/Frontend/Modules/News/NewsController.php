<?php
namespace App\Frontend\Modules\News;
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
        $numberOfCharacters = $this->app->getConfiguration()->getVar('news_character');

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
                $summary = substr($summary, 0, strrpos());
            }
        }

    }
}
