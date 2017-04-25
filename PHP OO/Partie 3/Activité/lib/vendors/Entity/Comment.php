<?php
namespace Entity;

use OCFram\Entity;
use \DateTime;

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
    protected $news = null;

	/**
	 * Author of the comment.
	 * @var String
	 * @access protected
	 */
	protected  $author = null;

	/**
	 * Content of the comment.
	 * @var String
	 * @access protected
	 */
	protected  $content = null;

	/**
	 * Date indicating when the comment has been added.
	 * @var DateTime
	 * @access protected
	 */
	protected  $date = null;

    /////////////
    // Methods //
    /////////////


    public function isValid()
    {
        return (!empty($this->author) and !empty($this->content));
    }

    /////////////
    // Setters //
    /////////////


    /**
     * Set the primary key.
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
     * Set the Author.
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
     * Set the content.
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
     * Set the creation date.
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
     * Return the foreign key.
     * @return ?int
     */
    public function getNews(): ?int
    {
        return $this->news;
    }

    /**
     * Return the author.
     * @return ?String
     */
    public function getAuthor(): ?String
    {
        return $this->author;
    }

    /**
     * Return the content.
     * @return ?String
     */
    public function getContent(): ?String
    {
        return $this->content;
    }

    /**
     * Return the creation date.
     * @return ?DateTime
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

}
