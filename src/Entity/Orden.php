<?php

namespace App\Entity;

// use App\Repository\OrdenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ORDEN")
 * @ORM\Entity
 */
class Orden
{
    /**
     * @ORM\Id
     * @ORM\Column(name="IDORDEN",type="string")
     */
    private $idOrden;

    /**
     * @ORM\Column(name="ESTADO",type="string", length=30)
     */
    private $estado;
    /**
     * @ORM\Column(name="COSTOTOTAL",type="decimal",precision=9, scale=2)
     */
    private $costoTotal;

    /**
     * @ORM\Column(name="DIRECCIONORDEN",type="string", length=100)
     */
    private $direccionOrden;

    /**
     * @ORM\Column(name="CODIGOCLIENTE",type="string", length=30)
     */
    private $codigoCliente;

    /**
     * @ORM\Column(name="IDTIPOPAGO",type="integer")
     */
    private $idTipoPago;

    /**
     * @ORM\Column(name="CODIGOZONAREPARTO",type="string", length=30)
     */
    private $codigoZonaReparto;

    public function getIdOrden(): ?string
    {
        return $this->idOrden;
    }
      public function setIdOrden(string $idOrden): self
    {
        $this->idOrden=$idOrden;
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
    public function getCostoTotal(): ?float
    {
        return $this->costoTotal;
    }

    public function setCostoTotal(float $costoTotal): self
    {
        $this->costoTotal = $costoTotal;

        return $this;
    }

    public function getDireccionOrden(): ?string
    {
        return $this->direccionOrden;
    }

    public function setDireccionOrden(string $direccionOrden): self
    {
        $this->direccionOrden = $direccionOrden;

        return $this;
    }

    public function getCodigoCliente(): ?string
    {
        return $this->codigoCliente;
    }

    public function setCodigoCliente(string $codigoCliente): self
    {
        $this->codigoCliente = $codigoCliente;

        return $this;
    }

    public function getIdTipoPago(): ?int
    {
        return $this->idTipoPago;
    }

    public function setIdTipoPago(int $idTipoPago): self
    {
        $this->idTipoPago = $idTipoPago;

        return $this;
    }

    public function getCodigoZonaReparto(): ?string
    {
        return $this->codigoZonaReparto;
    }

    public function setCodigoZonaReparto(string $codigoZonaReparto): self
    {
        $this->codigoZonaReparto = $codigoZonaReparto;

        return $this;
    }
}
