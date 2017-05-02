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
     * @param  DataCache
     * @return bool
     */

     public function __construct(string $cacheFolderName = 'datas')
     {
        $this->cacheFolderName = $cacheFolderName;
     }

    public function save(DataCache $cache): bool
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $root = $xml->appendChild($xml->createElement('DataCache'));
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
     * @return ?DataCache
     */
    public function load(string $name): ?DataCache
    {
        $filename = __DIR__ . '/../../tmp/cache/' . $this->cacheFolderName . '/' . $name . '.xml';
        if (file_exists($filename)) {
            $xml = new DOMDocument;
            $xml->load($filename);

            $expirationDate = $elements = $xml->getElementsByTagName('expiration_date');
            $expirationDate = DateTime::createFromFormat('U', $expirationDate->item(0)->nodeValue);

            $serializedData = $elements = $xml->getElementsByTagName('Data');
            $data = unserialize($serializedData->item(0)->nodeValue);
            $dataCache = new DataCache($name, $data, $expirationDate);
            if ($dataCache->isValid()) {
                return $dataCache;
            } else {
                $this->delete($dataCache);
            }
        }
        return null;
    }


    /**
     * Supprime un fichier du cache.
     * @param  DataCache $cache [description]
     * @return bool             [description]
     */
    protected function delete(DataCache $cache): bool
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
    * @param  $cacheFolderName
    *
    * @return static
    */
    public function setCacheFolderName($cacheFolderName)
    {
        $this->cacheFolderName = $cacheFolderName;
        return $this;
    }

    /**
     * @return
     */
    public function getCacheFolderName()
    {
        return $this->cacheFolderName;
    }

}
