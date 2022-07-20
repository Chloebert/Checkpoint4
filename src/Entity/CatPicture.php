<?php

namespace App\Entity;

use App\Entity\Cat;
use App\Repository\CatPictureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CatPictureRepository::class)]
#[Vich\Uploadable]
class CatPicture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Cat::class, inversedBy: 'catPictures')]
    private ?Cat $cat;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $picture = null;

    #[Vich\UploadableField(mapping: 'cat_picture', fileNameProperty: 'picture')]
    private ?File $pictureFile = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $mainPicture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCat(): ?Cat
    {
        return $this->cat;
    }

    public function setCat(?Cat $cat): self
    {
        $this->cat = $cat;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function setPictureFile(File $picture = null): CatPicture
    {
        $this->pictureFile = $picture;
        return $this;
    }

    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }


    public function isMainPicture(): ?bool
    {
        return $this->mainPicture;
    }

    public function setMainPicture(?bool $mainPicture): self
    {
        $this->mainPicture = $mainPicture;

        return $this;
    }
}
