<?php

namespace CollecMe\CollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * AppUser
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity()
 */
class AppUser extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    // Provided by the Repository


    public function __construct() {
      parent::__construct();
    }



}
