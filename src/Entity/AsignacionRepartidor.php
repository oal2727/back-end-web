<?php

namespace App\Entity;

use App\Repository\AsignacionRepartidorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ASIGNACIONREPARTIDOR")
 * @ORM\Entity
 */
class AsignacionRepartidor
{
     /**
     * @ORM\Id
     * @ORM\Column(name="IDASIGNACION",type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
    * @ORM\SequenceGenerator(sequenceName="SEQUENCEASIGNACION", allocationSize=1, initialValue=1)
     */
    private $idAsignacion;
    /**
    * @ORM\Column(name="IDREPARTIDOR",type="integer", length=255)
    */
    private $idRepartidor;
     /**
     * @ORM\Column(name="IDADMINISTRADOR",type="integer", length=255)
     */
    private $idAdministrador;

    public function getIdAdministrador(): ?int
    {
        return $this->idAdministrador;
    }

    public function setIdAdministrador(int $idAdministrador): self
    {
        $this->idAdministrador = $idAdministrador;

        return $this;
    }
    public function getIdRepartidor(): ?string
    {
        return $this->idRepartidor;
    }
    public function setIdRepartidor(string $idRepartidor): self
    {
        $this->idRepartidor=$idRepartidor;
        return $this;
    }
}
