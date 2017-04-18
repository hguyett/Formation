<?php
namespace OCFram;
use OCFram\Hydrator;

/**
 *
 */
abstract class Field
{
    use Hydrator;

    ////////////////
    // Properties //
    ////////////////


    /**
     * @var String $label
     */
    protected $label;
    /**
     * @var String $name
     */
    protected $name;
    /**
     * @var String $value
     */
    protected $value;

    /////////////
    // Methods //
    /////////////


    abstract public function buildWidget(): String;

    function __construct(array $options = [])
    {
        # code...
    }


    public function isValid(): bool
    {

    }

    /////////////
    // Setters //
    /////////////


    /**
     * @param String $label
     *
     * @return static
     */
    public function setLabel(String $label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param String $name
     *
     * @return static
     */
    public function setName(String $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param String $value
     *
     * @return static
     */
    public function setValue(String $value)
    {
        $this->value = $value;
        return $this;
    }

    /////////////
    // Getters //
    /////////////


    /**
     * @return String
     */
    public function getLabel(): String
    {
        return $this->label;
    }

    /**
     * @return String
     */
    public function getName(): String
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getValue(): String
    {
        return $this->value;
    }
}
