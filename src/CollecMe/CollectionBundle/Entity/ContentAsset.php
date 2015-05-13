<?php

namespace CollecMe\CollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContentAsset
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ContentAsset
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="mime_type", type="string", length=128)
     */
    private $mimeType;


    /**
     * Set mimeType
     *
     * @param string $mimeType
     * @return ContentAsset
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string 
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }
}
