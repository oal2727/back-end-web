<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="PRODUCTO")
 * @ORM\Entity
 */
class Producto
{
    /**
     * @ORM\Id
     * @ORM\Column(name="CODIGO",type="string")
     */
    private $codigo;

    /**
     * @ORM\Column(name="NOMBRE",type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(name="DESCRIPCION",type="string", length=150)
     */
    private $descripcion;

    /**
     * @ORM\Column(name="STOCK",type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(name="COSTO",type="integer")
     */
    private $costo;

    /**
     * @ORM\Column(name="ESTADO",type="string", length=30)
     */
    private $estado;

    /**
    * @ORM\Column(name="IDCATEGORIA",type="integer")
     */
    private $idcategoria;

    

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }
    public function setCodigo(string $codigo): self
    {
        $this->codigo=$codigo;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCosto(): ?int
    {
        return $this->costo;
    }

    public function setCosto(int $costo): self
    {
        $this->costo = $costo;

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
    public function setIdCategoria(int $idcategoria): self
    {
         $this->idcategoria = $idcategoria;
        return $this;
    }

     public function getIdCategoria(): ?int
    {
        return $this->idcategoria;
    }
    

   
}
