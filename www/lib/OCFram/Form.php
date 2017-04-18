<?php
namespace OCFram;
use OCFram\Entity;
use OCFram\Field;

/**
 *
 */
class Form
{

    ////////////////
    // Properties //
    ////////////////

    /**
     * @var Entity $entity
     */
    protected $entity;
    /**
     * @var array $fields
     */
    protected $fields;

    /////////////
    // Methods //
    /////////////


    function __construct(Entity $entity)
    {
        $this->setEntity($entity);
    }


    public function add(Field $field): Form
    {
        # code...
    }


    public function createView(): String
    {
        # code...
    }


    public function isValid(): bool
    {
        # code...
    }

    /////////////
    // Setters //
    /////////////


    /**
     * @param Entity $entity
     *
     * @return static
     */
    public function setEntity(Entity $entity)
    {
        $this->entity = $entity;
        return $this;
    }

    /////////////
    // Getters //
    /////////////


    /**
     * @return Entity
     */
    public function getEntity(): Entity
    {
        return $this->entity;
    }
}
