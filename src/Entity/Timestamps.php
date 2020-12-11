<?php 

namespace App\Entity;
use DateTime;
use DateTimeInterface;
use App\Repository\ClienteRepository;
use Doctrine\ORM\Mapping as ORM;
/**
 * Trait TimeStampableTrait
 * @package App\Entity\Trait
 */
trait Timestamps{
	/**
     * @ORM\Column(name="FECHAAPROBACION",type="datetime",nullable=true)
     * @ORM\Version
     */
	private $createdAt;
	/**
     * @ORM\Column(name="FECHAACTUALIZACION",type="datetime",nullable=true)
     * @ORM\Version
     */
	private $updatedAt;

	  public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeInterface $timestamp): self
    {
        $this->createdAt = $timestamp;
        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $timestamp): self
    {
        $this->updatedAt = $timestamp;
        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtAutomatically()
    {
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime(date('d-m-Y h:i:s')));
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtAutomatically()
    {
        $this->setUpdatedAt(new \DateTime(date('d-m-Y h:i:s')));
    }


}


 ?>