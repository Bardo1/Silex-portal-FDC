<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Slide
 *
 * @ORM\Table(name="slide")
 * @ORM\Entity
 */
class Slide
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
     * @ORM\Column(name="portada", type="string")
     */
    private $portada;


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
     * @return Slide
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
     * Set portada
     *
     * @param string $portada
     * @return Slide
     */
    public function setPortada($portada)
    {
        $this->portada = $portada;

        return $this;
    }

    /**
     * Get portada
     *
     * @return string 
     */
    public function getPortada()
    {
        return $this->portada;
    }
}
