<?php
namespace OCFram;
use Exception;
use OCFram\Validator;

/**
 *
 */
class MaxLengthValidator extends Validator
{
    /**
     * @var int
     */
    protected $maxLength;


    public function __construct(String $errorMessage, int $maxLength)
    {
        parent::__construct($errorMessage);
        $this->maxLength = $maxLength;
    }


    public function isValid(String $value): bool
    {
        return (strlen($value) <= $this->maxLength);
    }


    /**
     * Set max lenght. Throws an Exception if maxLength < 0.
     * @param int $maxLength
     * @throws Exception
     * @return static
     */
    public function setMaxLength($maxLength)
    {
        if ($maxLength > 0) {
            $this->maxLength = $maxLength;
        } else {
            throw new Exception("Maximum length must be greater than zero.");
        }
        return $this;
    }

}
