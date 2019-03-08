<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\BaggageRepository")
 */
class Baggage
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
     * @ORM\Column(type="string", length=13, nullable=false, unique=true)
     * @Assert\Length(
     *      max = 13,
     *      maxMessage = "The follow code cannot be longer than {{ limit }} characters."
     * )
     * @Assert\Regex(
     *     pattern="/[a-zA-Z0-9]{13}/",
     *     match=true,
     *     message="Your code can only contain alphanumeric char."
     * )
     */
    private $followCode;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=false)
     * @Assert\Range(
     *      min = 0.0,
     *      max = 30.0,
     *      minMessage = "The minimum weight is {{ limit }}kg.",
     *      maxMessage = "The maximum weight is {{ limit }}kg."
     * )
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
