<?php
namespace OCFram;
use OCFram\Field;

/**
 *
 */
class StringField extends Field
{

    /**
     * @var int
     */
    protected $maxLength;

    public function buildWidget(): String
    {
        # code...
    }

    /**
     * @param int $maxLength
     *
     * @return static
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
        return $this;
    }
}
