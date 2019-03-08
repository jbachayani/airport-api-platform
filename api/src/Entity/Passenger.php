<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\PassengerRepository")
 */
class Passenger
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $firstName;

    /**
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=320)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $handicap;

    /**
     * @ORM\Column(type="integer")
     */
    private $baggage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PassengerHasFlight", mappedBy="passengers")
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getHandicap(): ?bool
    {
        return $this->handicap;
    }

    public function setHandicap(bool $handicap): self
    {
        $this->handicap = $handicap;

        return $this;
    }

    public function getBaggage(): ?int
    {
        return $this->baggage;
    }

    public function setBaggage(int $baggage): self
    {
        $this->baggage = $baggage;

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
            $passengerHasFlight->setPassengers($this);
        }

        return $this;
    }

    public function removePassengerHasFlight(PassengerHasFlight $passengerHasFlight): self
    {
        if ($this->passengerHasFlights->contains($passengerHasFlight)) {
            $this->passengerHasFlights->removeElement($passengerHasFlight);
            // set the owning side to null (unless already changed)
            if ($passengerHasFlight->getPassengers() === $this) {
                $passengerHasFlight->setPassengers(null);
            }
        }

        return $this;
    }
}
