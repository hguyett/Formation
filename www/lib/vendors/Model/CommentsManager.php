<?php
namespace Model;
use OCFram\Manager;
use Entity\News;
use Entity\Comment;

/**
 *
 */
abstract class CommentsManager extends Manager
{
    abstract public function getNewsComments(News $news): array;
    abstract public function save(Comment $comment): bool;
}
