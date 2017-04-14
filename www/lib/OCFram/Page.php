<?php
namespace OCFram;
use RuntimeException;

/**
 *
 */
class Page extends ApplicationComponent
{

    ////////////////
    // Properties //
    ////////////////

    /**
     * File used to generate the view
     * @var String
     */
    protected $contentFile;
    /**
     * Contains variables for the view
     * @var array
     */
    protected $vars = [];

    public function addVar(String $var, $value)
    {
        $this->vars[$var] = $value;
    }

    /**
     * Generate the content to send to the client using layouts and views files.
     * @return String Content to send.
     */
    public function generatePage(): String
    {
        if (!file_exists(realpath(__DIR__ . '/../../App/' . $this->app->getName() . '/Templates/layout.php'))) {
            throw new RuntimeException('No layout.php found in ' . realpath(__DIR__ . '/../../App/' . $this->app->getName() . '/Templates'));
        }

        $user = $this->app->getUser();

        extract($this->vars);
        ob_start();
        if (!file_exists($this->contentFile)) {
            $this->app->getUser()->setMessage('Aucune vue n\'est assignée à cette action.');
        } else {
            require $this->contentFile;
        }

        $content = ob_get_clean();

        ob_start();
        require realpath(__DIR__ . '/../../App/' . $this->app->getName() . '/Templates/layout.php');
        return ob_get_clean();
    }

    /**
     * @param String $contentFile
     *
     * @return static
     */
    public function setContentFile(String $contentFile)
    {
        $this->contentFile = $contentFile;
        return $this;
    }
}
