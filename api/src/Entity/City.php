<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
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
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Type(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="cities")
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Airport", mappedBy="city")
     */
    private $airports;

    public function __construct()
    {
        $this->airports = new ArrayCollection();
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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Airport[]
     */
    public function getAirports(): Collection
    {
        return $this->airports;
    }

    public function addAirport(Airport $airport): self
    {
        if (!$this->airports->contains($airport)) {
            $this->airports[] = $airport;
            $airport->setCity($this);
        }

        return $this;
    }

    public function removeAirport(Airport $airport): self
    {
        if ($this->airports->contains($airport)) {
            $this->airports->removeElement($airport);
            // set the owning side to null (unless already changed)
            if ($airport->getCity() === $this) {
                $airport->setCity(null);
            }
        }

        return $this;
    }
}
