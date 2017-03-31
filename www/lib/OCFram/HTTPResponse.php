<?php
namespace OCFram;
/**
 *
 */
class HTTPResponse extends ApplicationComponent
{
    /**
     * @var Page $page Page to send as response to a HTTP request.
     */
    protected $page;

    public function addHeader(String $header): void
    {
        header($header);
    }

    public function redirect(String $location): void
    {
        header('Location: ' . $location);
        exit;
    }

    /**
     * Redirect to a 404 error page.
     *
     * @todo implements
     */
    public function redirect404(): void
    {

    }

    public function send(): void
    {
        exit($this->page->getGeneratedPage());
    }

    public function setCookie(String $name, String $value = '', int $expire = 0, String $path = null, String $domain = null, bool $secure = false, bool $httpOnly = true)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }

    /**
     * @param Page $page
     *
     * @return static
     */
    public function setPage(Page $page)
    {
        $this->page = $page;
        return $this;
    }
}
