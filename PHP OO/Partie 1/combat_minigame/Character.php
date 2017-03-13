<?php
class Character
{
    /**
     * ID corresponding to MySQL entry for the instance.
     * @var int $id
     */
    private $id;
    /**
     * Character's name.
     * @var String $name
     */
    private $name;
    /**
     * Total damages taken by the character. Have to be >= 0 and < ::HEALTH_POINTS
     * @var int $damages
     */
    private $damages;

    const HIT_DAMAGES = 5;
    const HEALTH_POINTS = 100;
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
    }

    ///////////////
    // Mutateurs //
    ///////////////

    /**
     * Setter for ID. This function is private, it's only purpose is to be used by the hydrate function, called by the constructor, called by CharactersManager.
     * @param int $id ID for MySQL table.
     */
    private function setId(int $id)
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
        if (is_string($name)) {
            $this->name = $name;
        }
    }

    /**
     * Setter for damages.
     * @param int $damages Total damages taken by the character.
     */
    public function setDamages(int $damages)
    {
        if (is_int($damages) and $damages >= 0 and $damages <= self::HEALTH_POINTS) {
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

    public function hit(Character $character)
    {
        $character->receiveDamages(self::HIT_DAMAGES);
    }

    public function receiveDamages(int $damages)
    {
        if ($this->damages() + $damages >= self::HEALTH_POINTS) {
            //Character is dead
            $this->setDamages(self::DEAD);
        } else {
            $this->setDamages($this->damages() + $damages);
        }
    }
}
