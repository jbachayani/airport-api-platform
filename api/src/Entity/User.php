<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user_account")
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotNull
     * @ORM\Column(type="string", length=120, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @Assert\NotNull
     * @ORM\Column(type="string", length=120, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=320, nullable=false, unique=true)
     * @Assert\NotNull
     * @Assert\Type(type="string")
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = false
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotNull
     * @Assert\Type(type="string")
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {

    }


}
