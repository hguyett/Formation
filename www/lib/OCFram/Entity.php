<?php
namespace OCFram;
use Exception;
use ArrayAccess;
/**
 *
 */
class Entity implements \ArrayAccess
{

    ////////////////
    // Properties //
    ////////////////


    /**
     * Primary Key.
     * @var int
     */
    protected $id;

    /////////////
    // Methods //
    /////////////

    /**
	 * @access public
	 * @param array $dataArray Associative array containing properties values.
	 */
    function __construct(array $dataArray)
    {
        $this->hydrate($dataArray);
    }

    /**
	 * Hydrate the object.
	 * @access public
	 * @param array $dataArray Associative array containing properties values.
	 */
    public function hydrate(array $dataArray)
    {
        foreach ($dataArray as $key => $value) {
            static::offsetSet($key, $value);
        }
    }

    /**
     * Return true if the entity have not an ID. Else, return false.
     * @return bool
     */
    public function isNew(): bool
    {
        return empty($this->id);
    }

    //////////////////////////////
    // Implementing ArrayAccess //
    //////////////////////////////


    public function offsetExists(String $offset)
    {
        if (is_callable($getter = 'get' . ucfirst($offset))) {
            return static::$getter();
        }
    }

    public function offsetGet(String $offset)
    {
        if (is_callable($getter = 'get' . ucfirst($offset))) {
            return static::$getter();
        }
    }

    public function offsetSet(String $offset, $value)
    {
        if (is_callable($setter = 'set' . ucfirst($offset))) {
            static::$setter($value);
        }
    }

    /**
     * Offset cannot be unset ! Will throw an exception.
     * @throws Exception
     * @param mixed $offset
     */
    public function offsetUnset($offsetCannotBeUnset)
    {
        throw new Exception("Offset cannot be unset !");

    }

    /////////////
    // Setters //
    /////////////


    /**
    * Set the id of the entity
    * @param int $id
    *
    * @return static
    */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /////////////
    // Getters //
    /////////////


    /**
    * return the id of the entity.
    * @return int
    */
    public function getId(): int
    {
        return $this->id;
    }

}
