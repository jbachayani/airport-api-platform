<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\AirportRepository")
 */
class Airport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotNull
     * @Assert\Type(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3, nullable=false, unique=true)
     * @Assert\NotNull
     * @Assert\Type(type="string")
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     * @Assert\Type(type="int")
     */
    private $aircraftCapacity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="airports")
     */
    private $city;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAircraftCapacity(): ?int
    {
        return $this->aircraftCapacity;
    }

    public function setAircraftCapacity(int $aircraftCapacity): self
    {
        $this->aircraftCapacity = $aircraftCapacity;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}
