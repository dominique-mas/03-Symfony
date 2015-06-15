<?php

namespace Dominique\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dominique\BlogBundle\Entity\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreat", type="datetime")
     */
    private $dateCreat;
    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;
    /**
     * @var boolean
     *
     * @ORM\Column(name="pub", type="boolean")
     */
    private $pub;
    /**
     * @ORM\OneToOne(targetEntity="Dominique\BlogBundle\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * 
     */
    private $image;
    /**
     * @ORM\OneToMany(targetEntity="Dominique\BlogBundle\Entity\Comment", mappedBy="article", cascade={"persist", "remove"})
     */
    private $comments;
    /**
     * @ORM\ManyToMany(targetEntity="Dominique\BlogBundle\Entity\Category")
     */
    private $categories;

    public function __construct() {
        $this->dateCreat = new \Datetime();
        $this->pub = true;
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
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
     * Set dateCreat
     *
     * @param \DateTime $dateCreat
     * @return Article
     */
    public function setDateCreat($dateCreat)
    {
        $this->dateCreat = $dateCreat;

        return $this;
    }

    /**
     * Get dateCreat
     *
     * @return \DateTime 
     */
    public function getDateCreat()
    {
        return $this->dateCreat;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Article
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
     * Set pub
     *
     * @param boolean $pub
     * @return Article
     */
    public function setPub($pub)
    {
        $this->pub = $pub;

        return $this;
    }

    /**
     * Get pub
     *
     * @return boolean 
     */
    public function getPub()
    {
        return $this->pub;
    }

    /**
     * Set image
     *
     * @param \Dominique\BlogBundle\Entity\Image $image
     * @return Article
     */
    public function setImage(\Dominique\BlogBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Dominique\BlogBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add categories
     *
     * @param \Dominique\BlogBundle\Entity\Category $categories
     * @return Article
     */
    public function addCategory(\Dominique\BlogBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Dominique\BlogBundle\Entity\Category $categories
     */
    public function removeCategory(\Dominique\BlogBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add comments
     *
     * @param \Dominique\BlogBundle\Entity\Comment $comments
     * @return Article
     */
    public function addComment(\Dominique\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Dominique\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\Dominique\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
