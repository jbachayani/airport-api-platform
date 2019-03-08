<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as CustomAssert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\FlightScheduleRepository")
 */
class FlightSchedule
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
     * @ORM\Column(type="string", length=16, nullable=false, unique=true)
     * @Assert\Length(
     *      max = 16,
     *      maxMessage = "The code cannot be longer than {{ limit }} characters."
     * )
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]{16}/",
     *     match=true,
     *     message="Your code can only contain alphanumeric char."
     * )
     */
    private $code;

    /**
     * @CustomAssert\FlightDate
     * @ORM\Column(type="datetime")
     * @var \Datetime
     *
     * @ORM\Column(type="datetime", nullable=false)
     * @Assert\DateTime
     * @Assert\NotNull
     */
    private $depertureDate;

    /**
     * @var \Datetime
     *
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $arrivalDate;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\Type(type="int")
     * @Assert\NotNull
     */
    private $timeOfFlying;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\Type(type="string")
     * @Assert\NotNull
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aircraft", inversedBy="flightSchedules")
     */
    private $aircraft;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PassengerHasFlight", mappedBy="flightSchedules")
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
            $passengerHasFlight->setFlightSchedules($this);
        }

        return $this;
    }

    public function removePassengerHasFlight(PassengerHasFlight $passengerHasFlight): self
    {
        if ($this->passengerHasFlights->contains($passengerHasFlight)) {
            $this->passengerHasFlights->removeElement($passengerHasFlight);
            // set the owning side to null (unless already changed)
            if ($passengerHasFlight->getFlightSchedules() === $this) {
                $passengerHasFlight->setFlightSchedules(null);
            }
        }

        return $this;
    }
}
