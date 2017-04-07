<?php
namespace Entity;

use OCFram\Entity;

/**
 *
 */
class Comment extends Entity
{

    ////////////////
    // Properties //
    ////////////////

    /**
     * Foreign key.
     * @var int
     */
    protected $news;

	/**
	 * Author of the comment.
	 * @var String
	 * @access protected
	 */
	protected  $author;

	/**
	 * Content of the comment.
	 * @var String
	 * @access protected
	 */
	protected  $content;

	/**
	 * Date indicating when the comment has been added.
	 * @var DateTime
	 * @access protected
	 */
	protected  $date = null;

    public function isValid()
    {
        return (!empty($this->author) and !empty($this->content));
    }

    /////////////
    // Setters //
    /////////////


    /**
     * @param int $news
     *
     * @return static
     */
    public function setNews(int $news)
    {
        $this->news = $news;
        return $this;
    }

    /**
     * @param String $author
     *
     * @return static
     */
    public function setAuthor(String $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @param String $content
     *
     * @return static
     */
    public function setContent(String $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param DateTime $date
     *
     * @return static
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /////////////
    // Getters //
    /////////////


    /**
     * @return int
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * @return String
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return String
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

}
