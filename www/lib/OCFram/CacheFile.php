<?php
namespace OCFram;
use \DateTime;

/**
 *
 */
class CacheFile
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

    public function __construct(string $name, $data, DateTime $expirationDate)
    {
        $this->setName($name);
        $this->setData($data);
        $this->setExpirationDate($expirationDate);
    }

    public function isNotExpired(): bool
    {
        if ($this->expirationDate > new DateTime('now')) {
            return true;
        }
        return false;
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
     * @param mixed $data
     *
     * @return static
     */
    public function setData($data)
    {
        $this->data = $data;
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
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return DateTime
     */
    public function getExpirationDate(): DateTime
    {
        return $this->expirationDate;
    }

}
