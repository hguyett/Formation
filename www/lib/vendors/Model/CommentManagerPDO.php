<?php
namespace Model;
use PDO;
use PDOException;
use Entity\Comment;

/**
 *
 */
class CommentManagerPDO extends CommentManager
{

    public function setDao(PDO $dao)
    {
        $this->dao = $dao;
    }

    public function getList(): array
    {
        $commentList = $this->dao->query('SELECT * FROM comments ORDER BY date DESC');
        foreach ($commentList as &$commentData) {
            $commentData = $this->arrayToComment($commentData);
        }

        return $commentList;
    }

    protected function arrayToComment(array $commentData)
    {
        if (isset($commentData['date']) and is_string($commentData['date'])) {
            $commentData['date'] = new DateTime($commentData['date'], new DateTimeZone('Europe/Brussels'));
        }

        return new Comment($commentData);
    }

    public function save(Comment $comment): bool{
        return ($comment->isNew()) ? $this->save($comment) : $this->add($comment) ;
    }

    protected function add(Comment $comment): bool
    {
        $query = $this->dao->prepare('INSERT INTO comments (author, content, date) VALUES (:author, :content, NOW())');
        $query->bindValue(':author', $comment->getAuthor());
        $query->bindValue('content', $comment->getContent());
        // try {
            return $query->execute();
        // } catch (PDOException $e) {
        //     return false;
        // }
    }

    protected function update(Comment $comment): bool
    {
        $query = $this->dao->prepare('UPDATE comments SET author = :author, content =:content WHERE id = :id');
        $query->bindValue(':id', $comment->getId());
        $query->bindValue(':author', $comment->getAuthor());
        $query->bindValue('content', $comment->getContent());
        try {
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
