<?php
namespace OCFram;
use ReflectionClass;
use ReflectionProperty;

/**
 *
 */
trait EntitySerializer
{
    public function serialize()
    {
        $reflectionClass = new ReflectionClass($this);
        $reflectionProperties = $reflectionClass->getProperties();
        $serializedProperties = [];
        foreach ($reflectionProperties as $reflectionProperty) {
            /**
            * @var ReflectionProperty $reflectionProperty
            */
            $propertyName = $reflectionProperty->getName();
            $getter = $propertyName;
            $serializedProperties[$propertyName] =  $this->$getter();
        }
        return serialize($serializedProperties);
    }

    public function unserialize($serializedEntity)
    {
        $entityData = unserialize($serializedEntity);
        // hydrating the object
        $this->hydrate($entityData);
    }
}
