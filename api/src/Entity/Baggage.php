<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BaggageRepository")
 */
class Baggage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $followCode;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFollowCode(): ?string
    {
        return $this->followCode;
    }

    public function setFollowCode(string $followCode): self
    {
        $this->followCode = $followCode;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }
}
