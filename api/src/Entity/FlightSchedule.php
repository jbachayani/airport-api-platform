<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlightScheduleRepository")
 */
class FlightSchedule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $code;

    /**
     * @ORM\Column(type="datetime")
     */
    private $depertureDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arrivalDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $timeOfFlying;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aircraft", inversedBy="flightSchedules")
     */
    private $aircraft;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PassengerHasFlight", mappedBy="flightSchedules")
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDepertureDate(): ?\DateTimeInterface
    {
        return $this->depertureDate;
    }

    public function setDepertureDate(\DateTimeInterface $depertureDate): self
    {
        $this->depertureDate = $depertureDate;

        return $this;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getTimeOfFlying(): ?int
    {
        return $this->timeOfFlying;
    }

    public function setTimeOfFlying(int $timeOfFlying): self
    {
        $this->timeOfFlying = $timeOfFlying;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

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
            $passengerHasFlight->addFlightSchedule($this);
        }

        return $this;
    }

    public function removePassengerHasFlight(PassengerHasFlight $passengerHasFlight): self
    {
        if ($this->passengerHasFlights->contains($passengerHasFlight)) {
            $this->passengerHasFlights->removeElement($passengerHasFlight);
            $passengerHasFlight->removeFlightSchedule($this);
        }

        return $this;
    }
}
