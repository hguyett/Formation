<?php
namespace OCFram;

/**
 *
 */
abstract class Application
{
    /**
     * @var HTTPRequest $httpRequest http request send by the client.
     */
    protected $httpRequest;
    /**
     * @var HTTPResponse $httpResponse http response to send to the client.
     */
    protected $httpResponse;
    /**
     * @var String $name Name of the application.
     */
    protected $name;
    /**
     * @var User $user User of the application.
     */
    protected $user;

    public function __construct(String $name, User $user)
    {
        $this->$name = $name;
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        $this->user = $user;
    }

    abstract public function run();

    /**
     * @todo implements
     */
    public function getController(): Controller
    {

    }

    /**
     * @return HTTPRequest
     */
    public function getHttpRequest(): HTTPRequest
    {
        return $this->httpRequest;
    }

    /**
     * @return HTTPResponse
     */
    public function getHttpResponse(): HTTPResponse
    {
        return $this->httpResponse;
    }

    /**
     * @return String
     */
    public function getName(): String
    {
        return $this->name;
    }
}
