<?php
namespace Model;
use OCFram\Manager;
use Entity\Comment;

/**
 *
 */
abstract class CommentManager extends Manager
{
    abstract public function getList(): array;
    abstract public function save(Comment $comment): bool;
}
