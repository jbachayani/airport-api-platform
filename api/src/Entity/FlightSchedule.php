<?php

namespace App\Entity;

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
    private $tiÃmeOfFlying;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aircraft", inversedBy="flightSchedules")
     */
    private $aircraft;

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

    public function getTiÃmeOfFlying(): ?int
    {
        return $this->tiÃmeOfFlying;
    }

    public function setTiÃmeOfFlying(int $tiÃmeOfFlying): self
    {
        $this->tiÃmeOfFlying = $tiÃmeOfFlying;

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
}
