<?php
namespace Model;

use \OCFram\Manager;;
use \OCFram\CacheFile;
use \OCFram\CacheManager;
use \Entity\News;


abstract class NewsManager extends Manager
{
    // Défini la période de temps après laquelle une donnée n'est plus valide en cache.
    const CACHE_EXPIRATION_TIME = 'PT15M';

  /**
   * Méthode permettant d'ajouter une news.
   * @param $news News La news à ajouter
   * @return void
   */
  abstract protected function add(News $news);

  /**
   * Méthode permettant d'enregistrer une news.
   * @param $news News la news à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(News $news)
  {
    if ($news->isValid())
    {
      $news->isNew() ? $this->add($news) : $this->modify($news);
    }
    else
    {
      throw new \RuntimeException('La news doit être validée pour être enregistrée');
    }
  }

  /**
   * Méthode renvoyant le nombre de news total.
   * @return int
   */
  abstract public function count();

  /**
   * Méthode permettant de supprimer une news.
   * @param $id int L'identifiant de la news à supprimer
   * @return void
   */
  abstract public function delete($id);

  /**
   * Méthode retournant une liste de news demandée.
   * @param $debut int La première news à sélectionner
   * @param $limite int Le nombre de news à sélectionner
   * @return array La liste des news. Chaque entrée est une instance de News.
   */
  abstract public function getList($debut = -1, $limite = -1);

  /**
   * Méthode retournant une news précise.
   * @param $id int L'identifiant de la news à récupérer
   * @return News La news demandée
   */
  abstract public function getUnique($id);

  /**
   * Sauvegarde une news en cache.
   * @var News $news
   */
  public function saveNewsToCache(News $news)
  {
      $cache = new CacheFile('News-' . $news->id(), $news, (new \DateTime)->add(new \DateInterval(self::CACHE_EXPIRATION_TIME)));
      $cacheManager = new CacheManager;
      $cacheManager->save($cache);
  }

  /**
   * Supprime une news du cache.
   * @return bool Renvoie true si un fichier a été supprimé.
   */
  public function clearNewsFromCache(int $id): bool
  {
      $cacheManager = new CacheManager;
      return $cacheManager->deleteByName('News-' . $id);
  }

  public function loadNewsFromCache(int $id): ?News
  {
      $cacheManager = new CacheManager;
      $newsCache = $cacheManager->load('News-' . $id);
      if (isset($newsCache)) {
          return $newsCache->getData();
      }
      return null;
  }

  /**
   * Méthode permettant de modifier une news.
   * @param $news news la news à modifier
   * @return void
   */
  abstract protected function modify(News $news);
}
