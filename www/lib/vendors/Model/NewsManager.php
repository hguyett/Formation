<?php
namespace OCFram\Model;

/**
 * Manage News in the database.
 */

abstract class NewsManager extends Manager
{
	abstract public function get(int $id) : News;
	abstract public function getList(int $numberOfNews = null, int $startPosition = null) : array;
    abstract public function save(News $news) : bool;
	abstract public function delete(News  $news) : bool;
}
