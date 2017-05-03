<?php
namespace OCFram;
use \DOMDocument;
use \DateTime;
// Les entités sont utilisées lors de la désérialisation de celles-ci.
use \Entity;

/**
 *
 */
class CacheManager
{
    /**
     * @var string $cacheFolderName
     */
    protected $cacheFolderName;

    /**
     * Sauvegarde l'objet dans un fichier XML.
     * @param  CacheFile
     * @return bool
     */

     public function __construct(string $cacheFolderName = 'datas')
     {
        $this->cacheFolderName = $cacheFolderName;
     }

    public function save(CacheFile $cache): bool
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $root = $xml->appendChild($xml->createElement('CacheFile'));
        $root->appendChild($xml->createElement('expiration_date', $cache->getExpirationDate()->getTimestamp()));
        $root->appendChild($xml->createElement('Data', serialize($cache->getData())));

        $xml->formatOutput = true;
        if (is_int($xml->save(__DIR__ . '/../../tmp/cache/' . $this->cacheFolderName . '/' . $cache->getName() . '.xml'))) {
            return true;
        }
        return false;
    }

    /**
     * Tente de charger la donnée depuis le cache. Si aucune donnée n'est trouvée, retourn null. Si la donnée est trouvée mais a expiré, elle est supprimée et la fonction renvoie null.
     * @param string Nom de la donnée à charger.
     * @return ?CacheFile
     */
    public function load(string $name): ?CacheFile
    {
        $filename = __DIR__ . '/../../tmp/cache/' . $this->cacheFolderName . '/' . $name . '.xml';
        if (file_exists($filename)) {
            $xml = new DOMDocument;
            $xml->load($filename);

            $expirationDate = $elements = $xml->getElementsByTagName('expiration_date');
            $expirationDate = DateTime::createFromFormat('U', $expirationDate->item(0)->nodeValue);

            $serializedData = $elements = $xml->getElementsByTagName('Data');
            $data = unserialize($serializedData->item(0)->nodeValue);
            $cache = new CacheFile($name, $data, $expirationDate);
            if ($cache->isNotExpired()) {
                return $cache;
            } else {
                $this->delete($cache);
            }
        }
        return null;
    }


    /**
     * Supprime un fichier du cache. Renvoie true si un fichier a été supprimé.
     * @param  CacheFile $cache CacheFile à supprimer.
     * @return bool
     */
    public function delete(CacheFile $cache): bool
    {
        $filename = __DIR__ . '/../../tmp/cache/' . $this->cacheFolderName . '/' . $cache->getName() . '.xml';
        if (file_exists($filename)) {
            if (unlink($filename)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Supprime un fichier du cache. Renvoie true si un fichier a été supprimé.
     * @param  string $cache Nom du cache à supprimer.
     * @return bool
     */
    public function deleteByName(string $cacheName): bool
    {
        $filename = __DIR__ . '/../../tmp/cache/' . $this->cacheFolderName . '/' . $cacheName . '.xml';
        if (file_exists($filename)) {
            if (unlink($filename)) {
                return true;
            }
        }
        return false;
    }

    /**
    * @param  $cacheFolderName
    *
    * @return static
    */
    public function setCacheFolderName(string $cacheFolderName)
    {
        $this->cacheFolderName = $cacheFolderName;
        return $this;
    }

    /**
     * @return
     */
    public function getCacheFolderName(): string
    {
        return $this->cacheFolderName;
    }

}
