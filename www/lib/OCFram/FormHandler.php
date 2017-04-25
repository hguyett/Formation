<?php
namespace OCFram;
use OCFram\Form;
use OCFram\Manager;
use OCFram\HTTPRequest;

/**
 *
 */
class FormHandler
{
    /**
     * @var Form
     */
    protected $form;
    /**
     * @var Manager
     */
    protected $manager;
    /**
     * @var HTTPRequest
     */
    protected $httpRequest;

    public function __construct(Form $form, Manager $manager, HTTPRequest $httpRequest)
    {
        $this->setForm($form)->setManager($manager)->setHttpRequest($httpRequest);
    }

    public function process(): bool
    {
        if ($this->form->isValid()) {
            if ($this->manager->save($this->form->getEntity())) {
                return true;
            }
        }
        return false;
    }

    /////////////
    // Setters //
    /////////////

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

    /**
     * @param Manager $manager
     *
     * @return static
     */
    public function setManager(Manager $manager)
    {
        $this->manager = $manager;
        return $this;
    }

    /**
     * @param HTTPRequest $httpRequest
     *
     * @return static
     */
    public function setHttpRequest(HTTPRequest $httpRequest)
    {
        $this->httpRequest = $httpRequest;
        return $this;
    }
}
