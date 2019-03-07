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
     * @ORM\ManyToOne(targetEntity="App\Entity\Seat", inversedBy="passengerHasFlights")
     */
    private $seats;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Passenger", inversedBy="passengerHasFlights")
     */
    private $passengers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FlightSchedule", inversedBy="passengerHasFlights")
     */
    private $flightSchedules;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPassengers(): ?Passenger
    {
        return $this->passengers;
    }

    public function setPassengers(?Passenger $passengers): self
    {
        $this->passengers = $passengers;

        return $this;
    }

    public function getFlightSchedules(): ?FlightSchedule
    {
        return $this->flightSchedules;
    }

    public function setFlightSchedules(?FlightSchedule $flightSchedules): self
    {
        $this->flightSchedules = $flightSchedules;

        return $this;
    }
}
