<?php

namespace CollecMe\CollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemCollection
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ItemCollection
{
     public function __construct()
     {
       $this->ownedItems = new ArrayCollection();
     }



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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;


    /**
    * @ORM\OneToMany(targetEntity="OwnerShip",mappedBy="userCollection")
    */
    private $ownedItems;


    /**
    * @ORM\ManyToOne(targetEntity="AppUser")
    */
    private $collector;


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
     * Set name
     *
     * @param string $name
     * @return ItemCollection
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return ItemCollection
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Add ownedItems
     *
     * @param \CollecMe\CollectionBundle\Entity\OwnerShip $ownedItems
     * @return ItemCollection
     */
    public function addOwnedItem(\CollecMe\CollectionBundle\Entity\OwnerShip $ownedItems)
    {
        $this->ownedItems[] = $ownedItems;

        return $this;
    }

    /**
     * Remove ownedItems
     *
     * @param \CollecMe\CollectionBundle\Entity\OwnerShip $ownedItems
     */
    public function removeOwnedItem(\CollecMe\CollectionBundle\Entity\OwnerShip $ownedItems)
    {
        $this->ownedItems->removeElement($ownedItems);
    }

    /**
     * Get ownedItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOwnedItems()
    {
        return $this->ownedItems;
    }

    /**
     * Set collector
     *
     * @param \CollecMe\CollectionBundle\Entity\AppUser $collector
     * @return ItemCollection
     */
    public function setCollector(\CollecMe\CollectionBundle\Entity\AppUser $collector = null)
    {
        $this->collector = $collector;

        return $this;
    }

    /**
     * Get collector
     *
     * @return \CollecMe\CollectionBundle\Entity\AppUser 
     */
    public function getCollector()
    {
        return $this->collector;
    }
}
