<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\SeatRepository")
 */
class Seat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aircraft", inversedBy="seats")
     */
    private $aircraft;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PassengerHasFlight", mappedBy="seats")
     */
    private $passengerHasFlights;

    public function __construct()
    {
        $this->passengerHasFlights = new ArrayCollection();
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

    public function getAircraft(): ?Aircraft
    {
        return $this->aircraft;
    }

    public function setAircraft(?Aircraft $aircraft): self
    {
        $this->aircraft = $aircraft;

        return $this;
    }

    /**
     * @return Collection|PassengerHasFlight[]
     */
    public function getPassengerHasFlights(): Collection
    {
        return $this->passengerHasFlights;
    }

    public function addPassengerHasFlight(PassengerHasFlight $passengerHasFlight): self
    {
        if (!$this->passengerHasFlights->contains($passengerHasFlight)) {
            $this->passengerHasFlights[] = $passengerHasFlight;
            $passengerHasFlight->setSeats($this);
        }

        return $this;
    }

    public function removePassengerHasFlight(PassengerHasFlight $passengerHasFlight): self
    {
        if ($this->passengerHasFlights->contains($passengerHasFlight)) {
            $this->passengerHasFlights->removeElement($passengerHasFlight);
            // set the owning side to null (unless already changed)
            if ($passengerHasFlight->getSeats() === $this) {
                $passengerHasFlight->setSeats(null);
            }
        }

        return $this;
    }
}
