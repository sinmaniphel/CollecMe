<?php

namespace CollecMe\CollectionBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Collectible
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Collectible
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank();
     * @ORM\Column(name="col_name", type="string", length=255)
     */
    private $colName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="col_date", type="date")
     * @Assert\Type("\DateTime")
     */
    private $colDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="col_is_circa", type="boolean")
     */
    private $colIsCirca;


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
     * Set colName
     *
     * @param string $colName
     * @return Collectible
     */
    public function setColName($colName)
    {
        $this->colName = $colName;
        return $this;
    }

    /**
     * Get colName
     *
     * @return string 
     */
    public function getColName()
    {
        return $this->colName;
    }

    /**
     * Set colDate
     *
     * @param \DateTime $colDate
     * @return Collectible
     */
    public function setColDate($colDate)
    {
        $this->colDate = $colDate;

        return $this;
    }

    /**
     * Get colDate
     *
     * @return \DateTime 
     */
    public function getColDate()
    {
        return $this->colDate;
    }

    /**
     * Set colIsCirca
     *
     * @param boolean $colIsCirca
     * @return Collectible
     */
    public function setColIsCirca($colIsCirca)
    {
        $this->colIsCirca = $colIsCirca;

        return $this;
    }

    /**
     * Get colIsCirca
     *
     * @return boolean 
     */
    public function getColIsCirca()
    {
        return $this->colIsCirca;
    }


    /**
     * @var text 
     * @ORM\Column(name="col_description", type="text")
     * @Assert\NotBlank();
     */
    private $colDescription;

    

    

    /**
     * Set colDescription
     *
     * @param string $colDescription
     * @return Collectible
     */
    public function setColDescription($colDescription)
    {
        $this->colDescription = $colDescription;

        return $this;
    }

    /**
     * Get colDescription
     *
     * @return string 
     */
    public function getColDescription()
    {
        return $this->colDescription;
    }
}
