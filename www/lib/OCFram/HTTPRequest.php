<?php
namespace OCFram;
/**
 *
 */
class HTTPRequest extends ApplicationComponent
{

    public function cookieExists(String $key): bool
    {
        return isset($_COOKIE[$key]);
    }

    public function cookieData(String $key): String
    {
        return ($this->cookieExists($key)) ? $_COOKE[$key] : null ;
    }

    public function getExists(String $key): bool
    {
        return isset($_GET[$key]);
    }

    public function getData(String $key): ?String
    {
        return ($this->getExists($key)) ? $_GET[$key] : null ;
    }

    public function method(): String
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function postExists(String $key): bool
    {
        return isset($_POST[$key]);
    }

    public function postData(String $key): ?String
    {
        return ($this->postExists($key)) ? $_POST[$key] : null ;
    }

    public function requestURI(): String
    {
        return $_SERVER['REQUEST_URI'];
    }
}
