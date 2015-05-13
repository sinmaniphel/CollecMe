<?php

namespace CollecMe\CollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppRole
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AppRole
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
     * @ORM\Column(name="roleName", type="string", length=32)
     */
    private $roleName;

    /**
     * @var string
     *
     * @ORM\Column(name="roleDescription", type="string", length=255)
     */
    private $roleDescription;


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
     * Set roleName
     *
     * @param string $roleName
     * @return AppRole
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * Set roleDescription
     *
     * @param string $roleDescription
     * @return AppRole
     */
    public function setRoleDescription($roleDescription)
    {
        $this->roleDescription = $roleDescription;

        return $this;
    }

    /**
     * Get roleDescription
     *
     * @return string
     */
    public function getRoleDescription()
    {
        return $this->roleDescription;
    }

}
