<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario
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
     * @ORM\Column(name="email", type="string", nullable=false, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="rut", type="string", nullable=false, unique=true)
     */
    private $rut;

    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", nullable=false)
     */
    private $clave;

    /**
     * @var \Entity\Contacto
     *
     * @ORM\OneToOne(targetEntity="Entity\Contacto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contacto_id", referencedColumnName="id", unique=true)
     * })
     */
    private $contacto;

    /**
     * @var \Entity\Informacion
     *
     * @ORM\OneToOne(targetEntity="Entity\Informacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="informacion_id", referencedColumnName="id", unique=true)
     * })
     */
    private $informacion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Entity\Postulacion", mappedBy="usuario")
     */
    private $postulaciones;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->postulaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set rut
     *
     * @param string $rut
     * @return Usuario
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get rut
     *
     * @return string 
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set clave
     *
     * @param string $clave
     * @return Usuario
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string 
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set contacto
     *
     * @param \Entity\Contacto $contacto
     * @return Usuario
     */
    public function setContacto(\Entity\Contacto $contacto = null)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return \Entity\Contacto 
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set informacion
     *
     * @param \Entity\Informacion $informacion
     * @return Usuario
     */
    public function setInformacion(\Entity\Informacion $informacion = null)
    {
        $this->informacion = $informacion;

        return $this;
    }

    /**
     * Get informacion
     *
     * @return \Entity\Informacion 
     */
    public function getInformacion()
    {
        return $this->informacion;
    }

    /**
     * Add postulaciones
     *
     * @param \Entity\Postulacion $postulaciones
     * @return Usuario
     */
    public function addPostulacione(\Entity\Postulacion $postulaciones)
    {
        $this->postulaciones[] = $postulaciones;

        return $this;
    }

    /**
     * Remove postulaciones
     *
     * @param \Entity\Postulacion $postulaciones
     */
    public function removePostulacione(\Entity\Postulacion $postulaciones)
    {
        $this->postulaciones->removeElement($postulaciones);
    }

    /**
     * Get postulaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostulaciones()
    {
        return $this->postulaciones;
    }
}
