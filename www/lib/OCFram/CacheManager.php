<?php
namespace OCFram;
use \DOMDocument;
use OCFram\DataCache;
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
        $xml->createTextNode();

        $xml->save(realpath(__DIR__ . '/../../tmp/cache/datas/' . $cache->getName()));
    }

    public function load(string $name): DataCache
    {
        // $xml = new \DOMDocument;
        // $xml->load(__DIR__.'/../../App/'.$this->app->name().'/Config/app.xml');
        //
        // $elements = $xml->getElementsByTagName('define');
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
