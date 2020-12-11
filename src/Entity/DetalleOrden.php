<?php

namespace App\Entity;

use App\Repository\DetalleOrdenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
  * @ORM\Table(name="DETALLEORDEN")
 * @ORM\Entity
 */
class DetalleOrden
{
    /**
     * @ORM\Id
     * @ORM\Column(name="IDORDEN",type="string")
     */
    private $idOrden;

    /**
     * @ORM\Id
     * @ORM\Column(name="IDPRODUCTO",type="string")
     */
    private $codigoProducto;

    /**
     * @ORM\Column(name="CANTIDAD",type="integer")
     */
    private $cantidad;

    /**
     * @ORM\Column(name="IMPORTE",type="float")
     */
    private $importe;

    public function getIdOrden(): ?int
    {
        return $this->idOrden;
    }
    public function setIdOrden(string $idOrden): self
    {
        $this->idOrden=$idOrden;
        return $this;
    }
    public function getCodigoProducto(): ?string
    {
        return $this->codigoProducto;
    }

    public function setCodigoProducto(string $codigoProducto): self
    {
        $this->codigoProducto = $codigoProducto;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getImporte(): ?float
    {
        return $this->importe;
    }

    public function setImporte(float $importe): self
    {
        $this->importe = $importe;

        return $this;
    }
}
