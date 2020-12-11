<?php

namespace App\Entity;

use App\Repository\ImagenProductoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ImagenProducto")
 * @ORM\Entity
 */

class ImagenProducto
{
    /**
     * @ORM\Id
     * @ORM\Column(name="IDIMAGEN",type="string",length=50)
     */
    private $id;

    /**
     * @ORM\Column(name="IMAGEURL",type="string", length=150)
     */
    private $imageUrl;
     /**
     * @ORM\Column(name="CODIGOPRODUCTO",type="string",length=5)
     */
    private $codigoProducto;


    public function getId(): ?string
    {
        return $this->id;
    }
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
    public function getCodigoProducto(): ?string
    {
        return $this->codigoProducto;
    }
    public function setCodigoProducto(string $codigoProducto): self
    {
        $this->codigoProducto=$codigoProducto;
        return $this;
    }

   

}
