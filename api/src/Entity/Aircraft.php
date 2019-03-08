<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"aircraft_read"}},
 *     denormalizationContext={"groups"={"aircraft_write"}},
 *     itemOperations={
 *         "get",
 *         "put",
 *         "delete"
 *     },
 *     collectionOperations={
 *          "get",
 *          "post",
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AircraftRepository")
 */
class Aircraft
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Groups({"aircraft_read", "aircraft_write"})
     */
    private $serialNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"aircraft_read", "aircraft_write"})
     */
    private $model;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"aircraft_read", "aircraft_write"})
     */
    private $capacity;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"aircraft_read", "aircraft_write"})
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"aircraft_read", "aircraft_write"})
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Seat", mappedBy="aircraft")
     * @Groups({"aircraft_read", "aircraft_write"})
     * @ApiSubresource()
     */
    private $seats;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Manufacturer", inversedBy="aircrafts")
     * @Groups({"aircraft_read", "aircraft_write"})
     */
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Airline", inversedBy="aircraft")
     * @Groups({"aircraft_read", "aircraft_write"})
     */
    private $airline;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FlightSchedule", mappedBy="aircraft")
     * @Groups({"aircraft_read", "aircraft_write"})
     */
    private $flightSchedules;

    /**
     * @ORM\Column(type="integer")
     */
    private $seatAvailable;

    public function __construct()
    {
        $this->seats = new ArrayCollection();
        $this->flightSchedules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Seat[]
     */
    public function getSeats(): Collection
    {
        return $this->seats;
    }

    public function addSeat(Seat $seat): self
    {
        if (!$this->seats->contains($seat)) {
            $this->seats[] = $seat;
            $seat->setAircraft($this);
        }

        return $this;
    }

    public function removeSeat(Seat $seat): self
    {
        if ($this->seats->contains($seat)) {
            $this->seats->removeElement($seat);
            // set the owning side to null (unless already changed)
            if ($seat->getAircraft() === $this) {
                $seat->setAircraft(null);
            }
        }

        return $this;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getAirline(): ?Airline
    {
        return $this->airline;
    }

    public function setAirline(?Airline $airline): self
    {
        $this->airline = $airline;

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
            $flightSchedule->setAircraft($this);
        }

        return $this;
    }

    public function removeFlightSchedule(FlightSchedule $flightSchedule): self
    {
        if ($this->flightSchedules->contains($flightSchedule)) {
            $this->flightSchedules->removeElement($flightSchedule);
            // set the owning side to null (unless already changed)
            if ($flightSchedule->getAircraft() === $this) {
                $flightSchedule->setAircraft(null);
            }
        }

        return $this;
    }

    public function getSeatAvailable(): ?int
    {
        return $this->seatAvailable;
    }

    public function setSeatAvailable(int $seatAvailable): self
    {
        $this->seatAvailable = $seatAvailable;

        return $this;
    }
}
