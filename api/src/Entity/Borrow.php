<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\BorrowRepository")
 */
class Borrow
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $borrowingDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $returnDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Borrowers", inversedBy="borrows")
     */
    private $borrower;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CopyBook", inversedBy="borrows")
     */
    private $copyBook;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowingDate(): ?\DateTimeInterface
    {
        return $this->borrowingDate;
    }

    public function setBorrowingDate(\DateTimeInterface $borrowingDate): self
    {
        $this->borrowingDate = $borrowingDate;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

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

    public function getBorrower(): ?Borrowers
    {
        return $this->borrower;
    }

    public function setBorrower(?Borrowers $borrower): self
    {
        $this->borrower = $borrower;

        return $this;
    }

    public function getCopyBook(): ?CopyBook
    {
        return $this->copyBook;
    }

    public function setCopyBook(?CopyBook $copyBook): self
    {
        $this->copyBook = $copyBook;

        return $this;
    }
}
