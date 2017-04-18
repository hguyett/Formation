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
    abstract public function get(int $id): Comment;
    abstract public function getNewsComments(News $news): array;
    abstract public function save(Comment $comment): bool;
    abstract public function delete(Comment $comment): bool;
    abstract public function deleteById(int $id): bool;
}
