<?php

namespace App\Entity;

use App\Repository\AprobacionOrdenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="APROBACIONORDEN")
 * @ORM\Entity
 */
class AprobacionOrden
{

    // use Timestamps;
    /**
    * @ORM\Id
    * @ORM\Column(name="IDADMINISTRADOR",type="integer", length=255)
    */
    private $idAdministrador;
     /**
    * @ORM\Id
     * @ORM\Column(name="IDORDEN",type="string", length=255)
     */
    private $idOrden;
    public function getIdAdministrador(): ?int
    {
        return $this->idAdministrador;
    }

    public function setIdAdministrador(int $idAdministrador): self
    {
        $this->idAdministrador = $idAdministrador;

        return $this;
    }
    public function getIdOrden(): ?string
    {
        return $this->idOrden;
    }
    public function setIdOrden(string $idOrden): self
    {
        $this->idOrden=$idOrden;
        return $this;
    }
}
