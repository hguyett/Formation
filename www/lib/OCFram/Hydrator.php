<?php
namespace OCFram;

/**
 *
 */
trait Hydrator
{
    function hydrate(array $assocData)
    {
        foreach ($assocData as $property => $value) {
            $method = 'set' . ucfirst($property);
            if (is_callable([$this, $method])) {
                $this->$method($value);
            }
        }
    }
}
