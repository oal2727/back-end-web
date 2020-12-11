<?php

namespace App\Entity;

use App\Repository\TipoDePagoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="TIPODEPAGO")
 * @ORM\Entity
 */
class TipoDePago
{
    /**
     * @ORM\Id
     * @ORM\Column(name="IDTIPOPAGO",type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
    * @ORM\SequenceGenerator(sequenceName="SEQUENCETIPOPAGO", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @ORM\Column(name='DESCRIPCION',type="string", length=30)
     */
    private $descripcion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}
