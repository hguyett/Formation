<?php
namespace Model;

use Entity\News;
use OCFram\Manager;
use OCFram\NotFoundException;

/**
 * Manage News in the database.
 */

abstract class NewsManager extends Manager
{
    /**
     * Return a news from the database.
     * @access public
     * @param  int  $id of the news to return.
     * @return News
     * @throws NotFoundException If no data is found, get() throws a NotFoundException.
     */
	abstract public function get(int $id) : News;
	abstract public function getList(int $numberOfNews = null, int $startPosition = null) : array;
    abstract public function save(News $news) : bool;
	abstract public function delete(News  $news) : bool;
}
