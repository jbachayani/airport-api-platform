<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\AirlineRepository")
 */
class Airline
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
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     * @Assert\NotNull
     * @Assert\Type(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotNull
     * @Assert\Type(type="string")
     */
    private $address;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false, unique=true)
     * @Assert\Type(type="int")
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(type="boolean", nullable=false)
     * @Assert\NotNull
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $creation_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aircraft", mappedBy="airline")
     */
    private $aircrafts;

    public function __construct()
    {
        $this->aircrafts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    /**
     * @return Collection|Aircraft[]
     */
    public function getAircrafts(): Collection
    {
        return $this->aircrafts;
    }

    public function addAircraft(Aircraft $aircraft): self
    {
        if (!$this->aircrafts->contains($aircraft)) {
            $this->aircrafts[] = $aircraft;
            $aircraft->setAirline($this);
        }

        return $this;
    }

    public function removeAircraft(Aircraft $aircraft): self
    {
        if ($this->aircrafts->contains($aircraft)) {
            $this->aircrafts->removeElement($aircraft);
            // set the owning side to null (unless already changed)
            if ($aircraft->getAirline() === $this) {
                $aircraft->setAirline(null);
            }
        }

        return $this;
    }
}
