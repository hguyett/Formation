<?php
namespace OCFram;
use \DateTime;

/**
 *
 */
abstract class DataCache
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var DateTime
     */
    protected $expirationDate;

    /**
     * Set cached data.
     * @param mixed $data
     */
    abstract public function setData($data): void;

    /**
     * Return cached data.
     * @return mixed
     */
    abstract public function getData();

    public function __construct(string $name, $data, DateTime $expirationDate)
    {
        $this->setName($name);
        $this->setData($data);
        $this->setExpirationDate($expirationDate);
    }

    /////////////
    // Setters //
    /////////////


    /**
     * @param string $name
     *
     * @return static
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param DateTime $expirationDate
     *
     * @return static
     */
    public function setExpirationDate(DateTime $expirationDate)
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    /////////////
    // Getters //
    /////////////


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DateTime
     */
    public function getExpirationDate(): DateTime
    {
        return $this->expirationDate;
    }

}
