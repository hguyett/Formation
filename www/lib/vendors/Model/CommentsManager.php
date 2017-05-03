<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Comment;
use \OCFram\CacheFile;
use \OCFram\CacheManager;

abstract class CommentsManager extends Manager
{
    // Défini la période de temps après laquelle une donnée n'est plus valide en cache.
    const CACHE_EXPIRATION_TIME = 'PT15M';

  /**
   * Méthode permettant d'ajouter un commentaire.
   * @param $comment Le commentaire à ajouter
   * @return void
   */
  abstract protected function add(Comment $comment);

  /**
   * Méthode permettant de supprimer un commentaire.
   * @param $id L'identifiant du commentaire à supprimer
   * @return void
   */
  abstract public function delete($id);

  /**
   * Méthode permettant de supprimer tous les commentaires liés à une news
   * @param $news L'identifiant de la news dont les commentaires doivent être supprimés
   * @return void
   */
  abstract public function deleteFromNews($news);

  /**
   * Méthode permettant d'enregistrer un commentaire.
   * @param $comment Le commentaire à enregistrer
   * @return void
   */
  public function save(Comment $comment)
  {
    if ($comment->isValid())
    {
      $comment->isNew() ? $this->add($comment) : $this->modify($comment);
    }
    else
    {
      throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
    }
  }

  /**
   * Méthode permettant de récupérer une liste de commentaires.
   * @param $news La news sur laquelle on veut récupérer les commentaires
   * @return array
   */
  abstract public function getListOf(int $news);

  /**
   * Sauvegarde une liste de commentaires en cache.
   * @var array $commentsList array of Comments
   */
  public function saveCommentsListToCache(array $commentsList)
  {
      if (isset($commentsList) and !empty($commentsList)) {
          $cache = new CacheFile('NewsCommentsList-' . $commentsList[0]->news(), $commentsList, (new \DateTime)->add(new \DateInterval(self::CACHE_EXPIRATION_TIME)));
          $cacheManager = new CacheManager;
          $cacheManager->save($cache);
      }
  }

  /**
   * Tente de charger une liste de commentaires du cache. Si aucune liste valide n'est trouvée, renvoie null.
   * @param  int    $newsId [description]
   * @return [type]         [description]
   */
  public function loadCommentsListFromCache(int $newsId): ?array
  {
      $cacheManager = new CacheManager;
      $commentsCache = $cacheManager->load('NewsCommentsList-' . $newsId);
      if (isset($commentsCache)) {
          return $commentsCache->getData();
      }
      return null;
  }

  /**
   * Supprime une liste de commentaires du cache.
   * @return bool Renvoie true si un fichier a été supprimé.
   */
  public function clearCommentsListFromCache(int $newsId): bool
  {
      $cacheManager = new CacheManager;
      return $cacheManager->deleteByName('NewsCommentsList-' . $newsId);
  }

  /**
   * Méthode permettant de modifier un commentaire.
   * @param $comment Le commentaire à modifier
   * @return void
   */
   abstract protected function modify(Comment $comment);

  /**
   * Méthode permettant d'obtenir un commentaire spécifique.
   * @param $id L'identifiant du commentaire
   * @return Comment
   */
  abstract public function get($id);
}
