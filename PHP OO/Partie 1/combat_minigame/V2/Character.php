<?php
/**
 * This class describes a character. A character have an id (for MySQL database), a name and an amount of damages taken.
 */
abstract class Character
{
    /**
     * ID corresponding to MySQL entry for the instance.
     * @var int $id
     */
    protected $id;
    /**
     * Character's name.
     * @var String $name
     */
    protected $name;
    /**
     * Total damages taken by the character. Have to be >= 0 and < ::HEALTH_POINTS
     * @var int $damages
     */
    protected $damages;
    /**
     * Define the class of the character.
     * @var String {'Warrior', 'Wizard'}
     */
    protected $class;

    /**
     * Amount of damage inflicted when hitting another character.
     * @var integer
     */
    const HIT_DAMAGES = 5;
    /**
     * Amount of Health points. When $damage reach it, the character is dead.
     * @var integer
     */
    const HEALTH_POINTS = 100;
    /**
     * Amount of damage required for a character to die.
     * @var integer
     */
    const DEAD = self::HEALTH_POINTS;

    //////////////////
    // Constructeur //
    //////////////////

    /**
     * Constructor for Character objects.
     * @param array $data Array from MySQL database.
     */
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    ///////////////
    // Hydrateur //
    ///////////////

    /**
     * Hydrate for Character objetcs.
     * @param  array  $data Array in MySQL format. [id, name, damages]
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        $this->setClass();
    }

    ///////////////
    // Mutateurs //
    ///////////////

    /**
     * Setter for ID. This function is private, it's only purpose is to be used by the hydrate function, called by the constructor, called by CharactersManager.
     * @param int $id ID for MySQL table.
     */
    protected function setId(int $id)
    {
        if (is_int($id) and $id > 0) {
            $this->id = $id;
        }
    }

    /**
     * Setter for Name.
     * @param String $name Character's name.
     */
    public function setName(String $name)
    {
        if (is_string($name) and !(empty($name))) {
            $this->name = $name;
        }
    }


    /**
     * Set the class of the character, regarding to the class of the object.
     */
    public function setClass()
    {
        $this->class = static::class;
    }

    /**
     * Setter for damages.
     * @param int $damages Total damages taken by the character.
     */
    public function setDamages(int $damages)
    {
        if (is_int($damages) and $damages >= 0 and $damages <= static::HEALTH_POINTS) {
            $this->damages = $damages;
        }
    }

    ////////////////
    // Accesseurs //
    ////////////////

    /**
     * Getter for ID.
     * @return int Database ID entry corresponding to the instance.
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * Getter for name.
     * @return String Character's name.
     */
    public function name(): String
    {
        return $this->name;
    }

    /**
     * Get the class of the character.
     *
     * @return String {'Warrior', 'Wizard'}
     */
    public function class()
    {
        return $this->class;
    }


    /**
     * Getter for damages.
     * @return int Damages taken by the character.
     */
    public function damages(): int
    {
        return $this->damages;
    }

    ///////////////
    // Fonctions //
    ///////////////

    abstract public function getSkillsList(): array;

    public function hit(Character $character)
    {
        $character->receiveDamages(static::HIT_DAMAGES);
    }

    public function receiveDamages(int $damages)
    {
        if ($this->damages() + $damages >= static::HEALTH_POINTS) {
            //Character is dead
            $this->setDamages(static::DEAD);
        } else {
            $this->setDamages($this->damages() + $damages);
        }
    }
}
