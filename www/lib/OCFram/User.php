<?php
namespace OCFram;

session_start();

/**
 *
 */
class User extends ApplicationComponent
{

    public function hasMessage(): bool
    {
        return isset($_SESSION['message']);
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    public function setAuthenticated(bool $authenticated = true)
    {
        $_SESSION['auth'] = $authenticated;
    }

    public function setAttribute(String $attr, $value)
    {
        $_SESSION[$attr] = $value;
    }

    public function setMessage(String $message)
    {
        $_SESSION['message'] = $message;
    }

    public function getAttribute()
    {
        return (isset($_SESSION[$attr])) ? $_SESSION[$attr] : null ;
    }

    public function getMessage(): String
    {
        if ($this->hasMessage()) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
            return $message;
        }
    }
}
