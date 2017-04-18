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
        # code...
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
