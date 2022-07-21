<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RateRepository::class)]
class Rate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'integer')]
    #[ORM\JoinColumn(nullable: true)]
    private ?int $rating;

    #[ORM\ManyToOne(targetEntity: Cat::class, inversedBy: 'rates')]
    private ?Cat $catId;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'rates')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $userId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getCatId(): ?Cat
    {
        return $this->catId;
    }

    public function setCatId(?Cat $catId): self
    {
        $this->catId = $catId;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}
