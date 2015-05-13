<?php

namespace CollecMe\CollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OwnerShip
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OwnerShip
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
     *
     * @ORM\OneToOne(targetEntity="Collectible")
     */
    private $collectible;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ItemCollection", inversedBy="ownedItems");
     */
    private $userCollection;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="since", type="datetime")
     */
    private $since;


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
     * Set collectible
     *
     * @param \stdClass $collectible
     * @return OwnerShip
     */
    public function setCollectible($collectible)
    {
        $this->collectible = $collectible;

        return $this;
    }

    /**
     * Get collectible
     *
     * @return \stdClass
     */
    public function getCollectible()
    {
        return $this->collectible;
    }

    /**
     * Set since
     *
     * @param \DateTime $since
     * @return OwnerShip
     */
    public function setSince($since)
    {
        $this->since = $since;

        return $this;
    }

    /**
     * Get since
     *
     * @return \DateTime
     */
    public function getSince()
    {
        return $this->since;
    }

    /**
     * Set userCollection
     *
     * @param \CollecMe\CollectionBundle\Entity\ItemCollection $userCollection
     * @return OwnerShip
     */
    public function setUserCollection(\CollecMe\CollectionBundle\Entity\ItemCollection $userCollection = null)
    {
        $this->userCollection = $userCollection;

        return $this;
    }

    /**
     * Get userCollection
     *
     * @return \CollecMe\CollectionBundle\Entity\ItemCollection 
     */
    public function getUserCollection()
    {
        return $this->userCollection;
    }
}
