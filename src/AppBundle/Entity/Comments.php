<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="comments", indexes={@ORM\Index(name="comments_articles", columns={"articles_id"}), @ORM\Index(name="comments_users", columns={"users_id"})})
 * @ORM\Entity
 */
class Comments
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Articles
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="articles_id", referencedColumnName="id")
     * })
     */
    private $articles;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     * })
     */
    private $users;

    /**
     * Set id
     *
     * @param string $id
     *
     * @return Articles
    */
    public function setId($id)
    {
      $this->id = $id;

      return $this;
    }

    /**
     * Get id
     *
     * @return string
    */
    public function getId()
    {
      return $this->id;
    }


    /**
     * Set articles_id
     *
     * @param string $articles_id
     *
     * @return Articles
    */
    public function setArticlesId($articlesId)
    {
      $this->articles = $articlesId;

      return $this;
    }

    /**
     * Get articles_id
     *
     * @return string
    */
    public function getArticlesId()
    {
      return $this->articles;
    }



    /**
     * Set users_id
     *
     * @param string $users_id
     *
     * @return Articles
    */
    public function setUsersId($usersId)
    {
      $this->users = $usersId;

      return $this;
    }

    /**
     * Get users_id
     *
     * @return string
    */
    public function getUsersId()
    {
      return $this->users;
    }



    /**
     * Set title
     *
     * @param string $title
     *
     * @return Articles
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
     * Set text
     *
     * @param string $text
     *
     * @return Articles
    */
    public function setText($text)
    {
      $this->text = $text;

      return $this;
    }

    /**
     * Get text
     *
     * @return string
    */
    public function getText()
    {
      return $this->text;
    }


}
