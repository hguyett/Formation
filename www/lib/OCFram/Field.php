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
    /**
     * Array of Validator objects.
     * @var array $validators
     */
    protected $validators = [];
    /**
     * Array of Strings.
     * @var array $errorMessages.
     */
    protected $errorMessages = [];

    /////////////
    // Methods //
    /////////////


    abstract public function buildWidget(): String;

    function __construct(array $options = [])
    {
        $this->hydrate($options);
    }


    public function isValid(): bool
    {
        $isValid = true;
        foreach ($this->getValidators() as $validator) {
            /**
             * @var Validator $validator
             */
            if ($validator->isValid($this->getValue())) {
                $isValid = false;
                $this->addErrorMessage($validator->getErrorMessage());
            }

            return $isValid;
        }
    }


    public function addValidator(Validator $validator)
    {
        if (!in_array($validator, $this->getValidators())) {
            $this->validators[] = $validator;
        }
    }

    public function addErrorMessage(String $errorMessage)
    {
        if (!in_array($errorMessage, $this->getErrorMessages())) {
            $this->errorMessages[] = $errorMessage;
        }
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

    /**
     * @param array $validators array of Validator objects.
     *
     * @return static
     */
    public function setValidators(array $validators)
    {
        foreach ($validators as $validator) {
            $this->addValidator($validator);
        }
        return $this;
    }

    /**
     * @param array $errorMessages
     *
     * @return static
     */
    public function setErrorMessages(array $errorMessages)
    {
        foreach ($errorMessages as $errorMessage) {
            $this->addErrorMessage($errorMessage);
        }
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

    /**
     * @return array
     */
    public function getValidators(): array
    {
        return $this->validators;
    }

    /**
     * @return array
     */
    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }
}
