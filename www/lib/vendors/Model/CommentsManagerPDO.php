<?php
namespace Model;

use \Entity\Comment;
use \OCFram\CacheFile;
use \OCFram\CacheManager;

class CommentsManagerPDO extends CommentsManager
{
  protected function add(Comment $comment)
  {
    $q = $this->dao->prepare('INSERT INTO comments SET news = :news, auteur = :auteur, contenu = :contenu, date = NOW()');

    $q->bindValue(':news', $comment->news(), \PDO::PARAM_INT);
    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());

    $q->execute();

    $comment->setId($this->dao->lastInsertId());

    // Supression du cache
    $this->clearCommentsListFromCache($comment->news());
  }

  public function delete($id)
  {
    $newsId = $this->get($id)->news();
    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);

    // Suppression du cache
    $this->clearCommentsListFromCache($newsId);
  }

  public function deleteFromNews($news)
  {
    $this->dao->exec('DELETE FROM comments WHERE news = '.(int) $news);

    // Supression du cache
    $this->clearCommentsListFromCache($news);
  }

  public function getListOf(int $news)
  {

    // Chargement de la liste en cache
    $comments = $this->loadCommentsListFromCache($news);

    // Si le cache est vide, la liste est chargée depuis la base de données
    if (!isset($comments)) {
        $q = $this->dao->prepare('SELECT id, news, auteur, contenu, date FROM comments WHERE news = :news');
        $q->bindValue(':news', $news, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

        $comments = $q->fetchAll();

        foreach ($comments as $comment)
        {
            $comment->setDate(new \DateTime($comment->date()));
        }

        // Sauvegarde de la liste en cache
        $this->saveCommentsListToCache($comments);
    }

    return $comments;
  }

  protected function modify(Comment $comment)
  {
    $q = $this->dao->prepare('UPDATE comments SET auteur = :auteur, contenu = :contenu WHERE id = :id');

    $q->bindValue(':auteur', $comment->auteur());
    $q->bindValue(':contenu', $comment->contenu());
    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);

    $q->execute();

    // Supression du cache
    $comment = $this->get($comment->id());
    $this->clearCommentsListFromCache($comment->news());
  }

  public function get($id)
  {
    $q = $this->dao->prepare('SELECT id, news, auteur, contenu FROM comments WHERE id = :id');
    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $q->execute();

    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

    return $q->fetch();
  }
}
