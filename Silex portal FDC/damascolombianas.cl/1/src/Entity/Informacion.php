<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Informacion
 *
 * @ORM\Table(name="informacion")
 * @ORM\Entity
 */
class Informacion
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
     * @ORM\Column(name="nombres", type="string")
     */
    private $nombres;
    /**
     * @var string
     *
     * @ORM\Column(name="apellido_paterno", type="string")
     */
    private $apellido_paterno;
    /**
     * @var string
     *
     * @ORM\Column(name="apellid_omaterno", type="string")
     */
    private $apellid_omaterno;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="datetime")
     */
    private $fecha_nacimiento;
    /**
     * @var string
     *
     * @ORM\Column(name="estado_civil", type="string")
     */
    private $estado_civil;
    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string")
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidad", type="string")
     */
    private $nacionalidad;
    /**
     * @var string
     *
     * @ORM\Column(name="curriculum", type="string")
     */
    private $curriculum;
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
     * Set nombres
     *
     * @param string $nombres
     * @return Informacion
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
        return $this;
    }
    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }
    /**
     * Set apellido_paterno
     *
     * @param string $apellidoPaterno
     * @return Informacion
     */
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellido_paterno = $apellidoPaterno;
        return $this;
    }
    /**
     * Get apellido_paterno
     *
     * @return string 
     */
    public function getApellidoPaterno()
    {
        return $this->apellido_paterno;
    }

    /**
     * Set apellid_omaterno
     *
     * @param string $apellidOmaterno
     * @return Informacion
     */
    public function setApellidOmaterno($apellidOmaterno)
    {
        $this->apellid_omaterno = $apellidOmaterno;
        return $this;
    }

    /**
     * Get apellid_omaterno
     *
     * @return string 
     */
    public function getApellidOmaterno()
    {
        return $this->apellid_omaterno;
    }

    /**
     * Set fecha_nacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Informacion
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fecha_nacimiento = $fechaNacimiento;
        return $this;
    }

    /**
     * Get fecha_nacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * Set estado_civil
     *
     * @param string $estadoCivil
     * @return Informacion
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estado_civil = $estadoCivil;
        return $this;
    }

    /**
     * Get estado_civil
     *
     * @return string 
     */
    public function getEstadoCivil()
    {
        return $this->estado_civil;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Informacion
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set nacionalidad
     *
     * @param string $nacionalidad
     * @return Informacion
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;
        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return string 
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set curriculum
     *
     * @param string $curriculum
     * @return Informacion
     */
    public function setCurriculum($curriculum)
    {
        $this->curriculum = $curriculum;
        return $this;
    }

    /**
     * Get curriculum
     *
     * @return string 
     */
    public function getCurriculum()
    {
        return $this->curriculum;
    }
}
