<?php

namespace App\Entity;

use App\Repository\RepartidorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="REPARTIDOR")
 * @ORM\Entity
 */
class Repartidor
{
    /**
     * @ORM\Id
     * @ORM\Column(name="IDREPARTIDOR",type="integer")
      * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="SEQUENCEREPARTIDOR", allocationSize=1, initialValue=1)
     */
    private $id;

 

    /**
     * @ORM\Column(name="NOMBRE",type="string", length=20)
     */
    private $nombre;

    /**
     * @ORM\Column(name="APELLIDO",type="string", length=20)
     */
    private $apellido;
    /**
     * @ORM\Column(name="DNI",type="string", length=10)
     */
     private $dni;
      /**
     * @ORM\Column(name="ESTADO",type="string", length=20)
     */
    private $estado;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }
    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
