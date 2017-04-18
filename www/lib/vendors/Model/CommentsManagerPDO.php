<?php
namespace Model;
use \PDO;
use \PDOStatement;
use \PDOException;
use Entity\News;
use Entity\Comment;
use \DateTime;
use \DateTimeZone;
use OCFram\PDOManager;
use OCFram\NotFoundException;

/**
 *
 */
class CommentsManagerPDO extends CommentsManager
{
    use OCFram\PDOManager;

    ////////////////////
    // Public methods //
    ////////////////////

    /**
    * Return a comment from the database. If the comment is not found, throws a NotFoundException.
    * @param  int     $id
    * @return Comment
    * @throws NotFoundException
    */
    public function get(int $id): Comment
    {
        $query = $this->getDao()->prepare('SELECT * FROM comments WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        if ($dataArray = $query->fetch()) {
            $comment = $this->arrayToComment($dataArray);
            return $comment;
        } else {
            throw new NotFoundException();
        }
    }


    /**
     * Return an array of Comment including the comments of the news.
     * @param News $news
     * @return array array of Comment
     */
    public function getNewsComments(News $news): array
    {
        /**
         * @var PDOStatement $commentList
         */
        $commentList = $this->getDao()->prepare('SELECT * FROM comments WHERE news = :newsId ORDER BY date DESC');
        $newsId = $news->getId();
        $commentList->bindParam(':newsId', $newsId, PDO::PARAM_INT);
        $commentList->execute();
        $commentList->setFetchMode(PDO::FETCH_ASSOC);
        $commentArray = [];
        foreach ($commentList as $commentData) {
            $commentArray[] = $this->arrayToComment($commentData);
        }

        return $commentArray;
    }


    public function delete(Comment $comment): bool
    {
        $query = $this->getDao()->prepare('DELETE FROM comments WHERE id = :id');
        $query->bindParam(':id', $comment->getId(), PDO::PARAM_INT);
        try {
            return $query->execute();
        } catch (PDOExeception $e) {
            return false;
        }
    }


    public function deleteById(int $id): bool
    {
        $query = $this->getDao()->prepare('DELETE FROM comments WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            return $query->execute();
        } catch (PDOExeception $e) {
            return false;
        }
    }


    public function save(Comment $comment): bool{
        return ($comment->isNew()) ? $this->add($comment) : $this->update($comment) ;
    }

    ///////////////////////
    // Protected methods //
    ///////////////////////

    protected function arrayToComment(array $commentData)
    {
        if (isset($commentData['date']) and is_string($commentData['date'])) {
            $commentData['date'] = new DateTime($commentData['date'], new DateTimeZone('Europe/Brussels'));
        }
        return new Comment($commentData);
    }

    protected function add(Comment $comment): bool
    {
        $query = $this->getDao()->prepare('INSERT INTO comments (news, author, content, date) VALUES (:news, :author, :content, NOW())');
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
        $query = $this->getDao()->prepare('UPDATE comments SET author = :author, content =:content WHERE id = :id');
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
