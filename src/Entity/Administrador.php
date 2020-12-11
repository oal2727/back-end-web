<?php

namespace App\Entity;

use App\Repository\AdministradorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="ADMINISTRADOR")
 * @ORM\Entity
 */
class Administrador implements UserInterface
{
     /**
     * @ORM\Id
     * @ORM\Column(name="IDADMINISTRADOR",type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
    * @ORM\SequenceGenerator(sequenceName="SEQUENCEADMINISTRADOR", allocationSize=1, initialValue=1)
     */
    private $id;
      /**
     * @ORM\Column(name="NOMBRE",type="string", length=20, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(name="APELLIDO",type="string", length=20, nullable=false)
     */
    private $apellido;
    /**
     * @ORM\Column(name="USUARIO",type="string", length=20)
     */
    private $username;
    /**
     * @ORM\Column(name="PASSWORD",type="string", length=30)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
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
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
      /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return string[] The user roles
     */
    public function getRoles(){
          // return $this->securityRoles;
    }

   
    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return md5(random_bytes(50));
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
     $this->plainPasword = null;
    }
}
