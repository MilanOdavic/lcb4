<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories", indexes={@ORM\Index(name="categories_users", columns={"users_id"})})
 * @ORM\Entity
 */
class Categories
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
       * Set users_id
       *
       * @param string $users_id
       *
       * @return Articles
      */
      public function setUsersId($usersId)
      {
        //$em = $this->getDoctrine()->getManager();
        //$user = $em->getRepository('AppBundle:User')->find($users_id);

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
}
