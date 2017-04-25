<?php
namespace OCFram;
use OCFram\Form;
use OCFram\Entity;

/**
 *
 */
abstract class FormBuilder
{

    /**
     * @var Form
     */
    protected $form;

    abstract public function build();

    public function __construct(Entity $entity)
    {
        $this->setForm(new Form($entity));
    }

    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param Form $form
     *
     * @return static
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
        return $this;
    }
}
