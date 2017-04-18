<?php
namespace OCFram;
use Exception;
use RuntimeException;
use InvalidArgumentException;
use ArrayAccess;

/**
 *
 */
class Entity implements \ArrayAccess
{
    use Hydrator;

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


    public function offsetExists($offset)
    {
        if (isset($offset) and is_string($offset)) {
            if (is_callable($getter = 'get' . ucfirst($offset))) {
                return true;
            }
        }
        return false;
    }

    public function offsetGet($offset)
    {
        if (isset($offset) and is_string($offset)) {
            $getter = 'get' . ucfirst($offset);
            if (is_callable('static::' . $getter)) {
                return static::$getter();
            } else {
                throw new RuntimeException('No getter found for the property ' . $offset);
            }
        } else {
            throw new InvalidArgumentException('Offset should be a String matching with a setter of the entity.');
        }
    }

    public function offsetSet($offset, $value)
    {
        if (isset($offset) and is_string($offset)) {
            $setter = 'set' . ucfirst($offset);
            if (is_callable('static::' . $setter)) {
                static::$setter($value);
            } else {
                throw new RuntimeException('No setter found for the property ' . $offset);
            }
        }else {
            throw new InvalidArgumentException('Offset should be a String.');
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
