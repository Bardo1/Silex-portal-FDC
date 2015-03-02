<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Foto
 *
 * @ORM\Table(name="foto")
 * @ORM\Entity
 */
class Foto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string")
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string")
     */
    private $descripcion;

    /**
     * @var \Entity\Album
     *
     * @ORM\ManyToOne(targetEntity="Entity\Album")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="album_id", referencedColumnName="id")
     * })
     */
    private $album;


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
     * Set url
     *
     * @param string $url
     * @return Foto
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Foto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set album
     *
     * @param \Entity\Album $album
     * @return Foto
     */
    public function setAlbum(\Entity\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \Entity\Album 
     */
    public function getAlbum()
    {
        return $this->album;
    }
}
