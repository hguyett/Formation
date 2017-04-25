<?php
namespace OCFram;

/**
 *
 */
class TextField extends Field
{

    ////////////////
    // Properties //
    ////////////////


    /**
     * @var int
     */
    protected $cols;
    /**
     * @var int
     */
    protected $rows;

    /////////////
    // Methods //
    /////////////


    public function buildWidget(): String
    {
        $widget = '<label for="' . htmlspecialchars($this->getName(), ENT_QUOTES, 'utf-8') . '">' . htmlspecialchars($this->getLabel(), ENT_QUOTES, 'utf-8') . '</label><textarea name="' . htmlspecialchars($this->getName(), ENT_QUOTES, 'utf-8') . '" id="' . htmlspecialchars($this->getName(), ENT_QUOTES, 'utf-8') . '"';
        if (isset($this->cols)) {
            $widget .= ' cols="' . htmlspecialchars($this->cols, ENT_QUOTES, 'utf-8') . '"';
        }
        if (isset($this->rows)) {
            $widget .= ' rows="' . htmlspecialchars($this->rows, ENT_QUOTES, 'utf-8') . '"';
        }
        $widget .= '>';
        if ($this->getValue() !== null) {
            $widget .= htmlspecialchars($this->getValue(), ENT_QUOTES, 'utf-8');
        }
        $widget .= '</textarea>';

        return $widget;
    }

    /////////////
    // Setters //
    /////////////


    /**
     * @param int $cols
     *
     * @return static
     */
    public function setCols($cols)
    {
        $this->cols = $cols;
        return $this;
    }

    /**
     * @param int $rows
     *
     * @return static
     */
    public function setRows($rows)
    {
        $this->rows = $rows;
        return $this;
    }

}
