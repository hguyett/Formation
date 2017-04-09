<?php
namespace Model;
use PDO;
use PDOStatement;
use PDOException;
use Entity\Comment;
use \DateTime;
use \DateTimeZone;

/**
 *
 */
class CommentsManagerPDO extends CommentsManager
{

    public function setDao(PDO $dao)
    {
        $this->dao = $dao;
    }

    public function getList(): array
    {
        /**
         * @var PDOStatement $commentList
         */
        $commentList = $this->dao->query('SELECT * FROM comments ORDER BY date DESC');
        $commentList->setFetchMode(PDO::FETCH_ASSOC);
        $commentArray = [];
        foreach ($commentList as $commentData) {
            $commentArray[] = $this->arrayToComment($commentData);
        }

        return $commentArray;
    }

    protected function arrayToComment(array $commentData)
    {
        if (isset($commentData['date']) and is_string($commentData['date'])) {
            $commentData['date'] = new DateTime($commentData['date'], new DateTimeZone('Europe/Brussels'));
        }
        return new Comment($commentData);
    }

    public function save(Comment $comment): bool{
        return ($comment->isNew()) ? $this->add($comment) : $this->update($comment) ;
    }

    protected function add(Comment $comment): bool
    {
        $query = $this->dao->prepare('INSERT INTO comments (news, author, content, date) VALUES (:news, :author, :content, NOW())');
        $query->bindValue(':news', $comment->getNews(), PDO::PARAM_INT);
        $query->bindValue(':author', $comment->getAuthor(), PDO::PARAM_STR);
        $query->bindValue('content', $comment->getContent(), PDO::PARAM_STR);
        // try {
            return $query->execute();
        // } catch (PDOException $e) {
        //     return false;
        // }
    }

    protected function update(Comment $comment): bool
    {
        $query = $this->dao->prepare('UPDATE comments SET author = :author, content =:content WHERE id = :id');
        $query->bindValue(':id', $comment->getId(), PDO::PARAM_STR);
        $query->bindValue(':author', $comment->getAuthor(), PDO::PARAM_STR);
        $query->bindValue('content', $comment->getContent(), PDO::PARAM_STR);
        try {
            return $query->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
