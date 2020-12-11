<?php

namespace App\Entity;

// use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CATEGORIA")
 * @ORM\Entity
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(name="IDCATEGORIA",type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
    * @ORM\SequenceGenerator(sequenceName="SEQUENCECATEGORIA", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @ORM\Column(name="DESCRIPCION",type="string", length=150, nullable=false)
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
