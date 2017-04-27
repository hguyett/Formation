<?php
namespace OCFram;
use \DOMDocument;
use \DateTime;
// Entity namespace is used by unserialize in load function to construct Entity objects.
use \Entity;

/**
 *
 */
class CacheManager
{
    public function save(DataCache $cache): bool
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $root = $xml->appendChild($xml->createElement('DataCache'));
        $root->appendChild($xml->createElement('expiration_date', $cache->getExpirationDate()->getTimestamp()));
        $root->appendChild($xml->createElement('Data', serialize($cache->getData())));

        $xml->formatOutput = true;
        if (is_int($xml->save(__DIR__ . '/../../tmp/cache/datas/' . $cache->getName() . '.xml'))) {
            return true;
        } else {
            return false;
        }
    }

    public function load(string $name): ?DataCache
    {
        $filename = __DIR__ . '/../../tmp/cache/datas/' . $cache->getName() . '.xml';
        if (file_exists($filename)) {
            $dataCache = new DataCache;
            $xml = new DOMDocument;
            $xml->load($filename);

            $expirationDate = $elements = $xml->getElementsByTagName('expiration_date');
            $expirationDate = new DateTime($expirationDate);

            $serializedData = $elements = $xml->getElementsByTagName('expiration_date');
            $data = unserialize($serializedData);

            return new DataCache($name, $data, $expirationDate);
        }
        //
        //
        // foreach ($elements as $element)
        // {
        //   $this->vars[$element->getAttribute('var')] = $element->getAttribute('value');
        // }
    }

    protected function isValid(): bool
    {
        # code...
    }

    protected function delete(DataCache $cache): bool
    {

    }

}
