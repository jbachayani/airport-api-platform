<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\ManufacturerRepository")
 */
class Manufacturer
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
     * @ORM\OneToMany(targetEntity="App\Entity\Aircraft", mappedBy="manufacturer")
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
            $aircraft->setManufacturer($this);
        }

        return $this;
    }

    public function removeAircraft(Aircraft $aircraft): self
    {
        if ($this->aircrafts->contains($aircraft)) {
            $this->aircrafts->removeElement($aircraft);
            // set the owning side to null (unless already changed)
            if ($aircraft->getManufacturer() === $this) {
                $aircraft->setManufacturer(null);
            }
        }

        return $this;
    }
}
