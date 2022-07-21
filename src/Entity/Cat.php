<?php

namespace App\Entity;

use App\Repository\CatRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatRepository::class)]
class Cat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $name;

    #[ORM\Column(type: 'datetime')]
    private ?DateTime $dateOfBirth;

    #[ORM\Column(type: 'text')]
    private ?string $description;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $goodPoint;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $badPoint;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $rating;

    #[ORM\Column(type: 'boolean')]
    private ?bool $catOfTheMonth;

    #[ORM\OneToMany(mappedBy: 'cat', targetEntity: CatPicture::class, cascade: ['persist', 'remove'])]
    private ?Collection $catPictures = null;

    #[ORM\OneToMany(mappedBy: 'catId', targetEntity: Rate::class)]
    private Collection $rates;

    public function __construct()
    {
        $this->catPictures = new ArrayCollection();
        $this->rates = new ArrayCollection();
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

    public function getDateOfBirth(): ?DateTime
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(DateTime $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

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

    public function getGoodPoint(): ?string
    {
        return $this->goodPoint;
    }

    public function setGoodPoint(string $goodPoint): self
    {
        $this->goodPoint = $goodPoint;

        return $this;
    }

    public function getBadPoint(): ?string
    {
        return $this->badPoint;
    }

    public function setBadPoint(string $badPoint): self
    {
        $this->badPoint = $badPoint;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function isCatOfTheMonth(): ?bool
    {
        return $this->catOfTheMonth;
    }

    public function setCatOfTheMonth(bool $catOfTheMonth): self
    {
        $this->catOfTheMonth = $catOfTheMonth;

        return $this;
    }

    public function getCatPictures(): ?Collection
    {
        return $this->catPictures;
    }

    public function setCatPictures(?Collection $catPictures): self
    {
        $this->catPictures = $catPictures;

        return $this;
    }

    /**
     * @return Collection<int, Rate>
     */
    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rates->contains($rate)) {
            $this->rates[] = $rate;
            $rate->setCatId($this);
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        if ($this->rates->removeElement($rate)) {
            // set the owning side to null (unless already changed)
            if ($rate->getCatId() === $this) {
                $rate->setCatId(null);
            }
        }

        return $this;
    }
}
