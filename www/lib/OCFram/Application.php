<?php
namespace OCFram;
use DOMElement;
use DOMDocument;
use RuntimeException;

/**
 *
 */
abstract class Application
{

    ////////////////
    // Properties //
    ////////////////


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
    /**
     * Contains the configuration variables for the application.
     * @var Config
     */
    protected $configuration;

    /////////////
    // Methods //
    /////////////


    public function __construct(String $name, User $user)
    {
        $this->$name = $name;
        $this->user = $user;
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        $this->configuration = new Config($this);
    }

    abstract public function run();

    /**
     * Read the http request and return a controller using a router.
     * @return BackController
     */
    public function getController(): BackController
    {
        $router = new Router;
        $xml = new DOMDocument;
        $routesModelsFilePath = __DIR__ . '/../../app/' . $this->name . '/Config/Routes.xml';

        if (file_exists($routesModelsFilePath)) {
            // Loading routes models
            $xml->load($routeModelsFilePath);
            foreach ($xml->getElementsByTagName('route') as $route) {
                $varsName = [];
                /**
                 * @var DOMElement $route
                 */
                $route;
                // Checking if the url must contains variables
                if ($route->hasAttribute('vars')) {
                    $varsName = explode(',', $route->getAttribute('vars'));
                }

                $routeModel = new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $varsName);

                $router->addRouteModel();
            }
        } else {
            throw new Exception('No routes file found (' . $routesModelsFilePath . ')');
        }

        //Checking if the url is fitting a route model.
        try {
            $matchedRoute = $router->createRoute($this->getHttpRequest()->requestURI());
        } catch (RuntimeException $e) {
            $this->httpResponse->redirect404();
        }
        /**
         * @var Route $matchedRoute
         */

        // Adding route variables to $_GET
        $_GET = array_merge($_GET, $matchedRoute->getVars());

        $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
    }

    /////////////
    // Getters //
    /////////////


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

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Config
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }
}
