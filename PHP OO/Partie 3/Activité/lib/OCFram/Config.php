<?php
namespace OCFram;
use DOMNode;
use DOMElement;
use DOMDocument;

/**
*
*/
class Config extends ApplicationComponent
{

    /**
     * @var array Contains config variables names and values.
     */
    protected $vars = [];

    /**
     * Return the value of the configuration variable if it exists. Else, return null.
     * @return ?String
     */
    function getVar(String $var): ?String
    {
        //loading variables
        if (empty($this->vars)) {
            $configFile = realpath(__DIR__ . '/../../App/' . $this->app->getName() . '/Config/app.xml');
            if (file_exists($configFile)) {
                $xml = new DOMDocument();
                $xml->load(realpath($configFile));
                foreach ($xml->getElementsByTagName('define') as $variable) {
                    /**
                     * @var DOMElement $variable
                     */
                    $this->vars[$variable->getAttribute('var')] = $variable->getAttribute('value');
                }
            } else {
                throw new RuntimeException('Configuration file not found (' . $configFile . ').');
            }
        }

        if (isset($this->vars[$var])) {
            return $this->vars[$var];
        } else {
            return null;
        }
    }

}
