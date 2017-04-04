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
    protected $vars;

    public function addVar(String $var, $value)
    {
        $this->vars[$var] = $value;
    }

    public function generatePage(): String
    {
        if (!file_exists(__DIR__ . '/../../App/' . $this->getApp() . '/Templates/layout.php')) {
            throw new RuntimeException('No layout.php found in ' . __DIR__ . '/../../App/' . $this->getApp() . '/Templates');
        }

        extract($this->vars);
        ob_start();
        require $this->contentFile;
        /**
         * @todo WTF is this $content variable ?
         */
        $content = ob_get_clean();

        ob_start();
        require __DIR__ . '/../../App/' . $this->getApp() . '/Templates/layout.php';
        return ob_get_clean();
    }

    /**
     * @param String $contentFile
     *
     * @return static
     */
    public function setContentFile(String $contentFile)
    {
        if (!file_exists($contentFile)) {
            throw new RuntimeException('View file ' . $contentFile . 'was not found.');
        }
        $this->contentFile = $contentFile;
        return $this;
    }
}
