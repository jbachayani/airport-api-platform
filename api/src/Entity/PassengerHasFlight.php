<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PassengerHasFlightRepository")
 */
class PassengerHasFlight
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Passenger", inversedBy="passengerHasFlights")
     */
    private $passengers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\FlightSchedule", inversedBy="passengerHasFlights")
     */
    private $flightSchedules;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seat", inversedBy="passengerHasFlights")
     */
    private $seats;

    public function __construct()
    {
        $this->passengers = new ArrayCollection();
        $this->flightSchedules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Passenger[]
     */
    public function getPassengers(): Collection
    {
        return $this->passengers;
    }

    public function addPassenger(Passenger $passenger): self
    {
        if (!$this->passengers->contains($passenger)) {
            $this->passengers[] = $passenger;
        }

        return $this;
    }

    public function removePassenger(Passenger $passenger): self
    {
        if ($this->passengers->contains($passenger)) {
            $this->passengers->removeElement($passenger);
        }

        return $this;
    }

    /**
     * @return Collection|FlightSchedule[]
     */
    public function getFlightSchedules(): Collection
    {
        return $this->flightSchedules;
    }

    public function addFlightSchedule(FlightSchedule $flightSchedule): self
    {
        if (!$this->flightSchedules->contains($flightSchedule)) {
            $this->flightSchedules[] = $flightSchedule;
        }

        return $this;
    }

    public function removeFlightSchedule(FlightSchedule $flightSchedule): self
    {
        if ($this->flightSchedules->contains($flightSchedule)) {
            $this->flightSchedules->removeElement($flightSchedule);
        }

        return $this;
    }

    public function getSeats(): ?Seat
    {
        return $this->seats;
    }

    public function setSeats(?Seat $seats): self
    {
        $this->seats = $seats;

        return $this;
    }
}
