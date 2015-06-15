<?php

namespace Dominique\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dominique\BlogBundle\Entity\CommentRepository")
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePost", type="datetime")
     */
    private $datePost;
    /**
     * @ORM\ManyToOne(targetEntity="Dominique\BlogBundle\Entity\Article", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    public function __construct() {
        $this->datePost = new \Datetime();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set datePost
     *
     * @param \DateTime $datePost
     * @return Comment
     */
    public function setDatePost($datePost)
    {
        $this->datePost = $datePost;

        return $this;
    }

    /**
     * Get datePost
     *
     * @return \DateTime 
     */
    public function getDatePost()
    {
        return $this->datePost;
    }

    /**
     * Set article
     *
     * @param \Dominique\BlogBundle\Entity\Article $article
     * @return Comment
     */
    public function setArticle(\Dominique\BlogBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Dominique\BlogBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
