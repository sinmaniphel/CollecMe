<?php

namespace CollecMe\CollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemCaracteristics
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ItemCaracteristics
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
     * @ORM\Column(name="carac_name", type="string", length=255)
     */
    private $caracName;

    /**
     * @var string
     *
     * @ORM\Column(name="carac_value", type="string", length=255)
     */
    private $caracValue;


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
     * Set caracName
     *
     * @param string $caracName
     * @return ItemCaracteristics
     */
    public function setCaracName($caracName)
    {
        $this->caracName = $caracName;

        return $this;
    }

    /**
     * Get caracName
     *
     * @return string 
     */
    public function getCaracName()
    {
        return $this->caracName;
    }

    /**
     * Set caracValue
     *
     * @param string $caracValue
     * @return ItemCaracteristics
     */
    public function setCaracValue($caracValue)
    {
        $this->caracValue = $caracValue;

        return $this;
    }

    /**
     * Get caracValue
     *
     * @return string 
     */
    public function getCaracValue()
    {
        return $this->caracValue;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Collectible")
     */
    private $collectible;

    public function setCollectible($collectible)
    {
        $this->collectible = $collectible;
    }

    public function getCollectible()
    {
        return $this->collectible;
    }
}
