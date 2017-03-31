<?php
namespace OCFram;

/**
 *
 */
abstract class ApplicationComponent
{
    /**
     * @var Application $app
     */
    protected $app;

    function __construct(Application $app)
    {
        $this->$app = $app;
    }

    /**
     * @return Application
     */
    public function getApp(): Application
    {
        return $this->app;
    }
}
