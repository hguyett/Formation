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
                $widget = '<label for="' . htmlspecialchars($this->getName(), ENT_QUOTES, 'utf-8') . '">' . htmlspecialchars($this->getLabel(), ENT_QUOTES, 'utf-8') . '</label><input type="text" id="' . htmlspecialchars($this->getName(), ENT_QUOTES, 'utf-8') . '" name="' . htmlspecialchars($this->getName(), ENT_QUOTES, 'utf-8') . '"';
                if ($this->getValue() !== null) {
                    $widget += ' value="' . htmlspecialchars($this->getValue(), ENT_QUOTES, 'utf-8') . '"';
                }
                if (isset($this->maxLength)) {
                    $widget += ' maxLength="' . htmlspecialchars($this->maxLength, ENT_QUOTES, 'utf-8') . '"';
                }
                $widget += '/>';
                return $widget;
    }

    /**
     * @param int $maxLength
     *
     * @return static
     */
    public function setMaxLength($maxLength)
    {
        if ($maxLength > 0) {
            $this->maxLength = $maxLength;
        } else {
            throw new Exception("MaxLength must be greater than zero.");
        }
        return $this;
    }
}
