<?php
namespace OCFram;

/**
 *
 */
abstract class Validator
{
    /**
     * Message to print if the validation fails
     * @var String
     */
    protected $errorMessage;

    abstract public function isValid(String $value): bool;


    public function __construct(String $errorMessage)
    {
        $this->setErrorMessage($errorMessage);
    }


    /**
    * @param String $errorMessage
    *
    * @return static
    */
    public function setErrorMessage(String $errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }


    /**
     * @return String
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

}
