<?php
namespace OCFram;
use OCFram\Entity;
use OCFram\Field;

/**
 * Build a Form using Field objects.
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
     * Array of Field objects.
     * @var array $fields
     */
    protected $fields = [];

    /////////////
    // Methods //
    /////////////


    function __construct(Entity $entity)
    {
        $this->setEntity($entity);
    }

    /**
     * Add a field to the form. The field name must correspond to a property of the entity, and a getter must exists for this property.
     * @param  Field $field
     * @return static
     */
    public function add(Field $field): Form
    {
        $propertyGetter = 'get' . ucfirst($field->getName());
        if ($this->entity->$propertyGetter() !== null) {
            $field->setValue($this->entity->$propertyGetter());
        }
        $this->fields[] = $field;
        return $this;
    }


    public function createView(): String
    {
        $view = '';
        foreach ($this->fields as $field) {
            /**
             * @var Field $field
             */
            $view .= $field->buildWidget() . '<br>';
        }

        return $view;
    }


    public function isValid(): bool
    {
        $valid = true;
        foreach ($this->fields as $field) {
            /**
             * @var Field $field
             */
            if (!$field->isValid()) {
                $valid = false;
            }
        }

        return $valid;
    }


    public function getErrorMessage(): ?String {
        $message = null;
        foreach ($this->getFields() as $formField) {
            /**
             * @var Field $formField
             */
            foreach ($formField->getErrorMessages() as $errorMessage) {
                $message .= PHP_EOL . $errorMessage . '<br>';
            }
        }
        return $message;
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

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
