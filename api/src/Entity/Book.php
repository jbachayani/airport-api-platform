<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *     normalizationContext={"groups"={"book_read"}},
 *     denormalizationContext={"groups"={"book_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"book_write"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="books")
     */
    private $author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publicationDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CopyBook", mappedBy="book")
     */
    private $copyBooks;

    public function __construct()
    {
        $this->copyBooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReference(): ?int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * @return Collection|CopyBook[]
     */
    public function getCopyBooks(): Collection
    {
        return $this->copyBooks;
    }

    public function addCopyBook(CopyBook $copyBook): self
    {
        if (!$this->copyBooks->contains($copyBook)) {
            $this->copyBooks[] = $copyBook;
            $copyBook->setBook($this);
        }

        return $this;
    }

    public function removeCopyBook(CopyBook $copyBook): self
    {
        if ($this->copyBooks->contains($copyBook)) {
            $this->copyBooks->removeElement($copyBook);
            // set the owning side to null (unless already changed)
            if ($copyBook->getBook() === $this) {
                $copyBook->setBook(null);
            }
        }

        return $this;
    }
}
