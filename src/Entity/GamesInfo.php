<?php

namespace App\Entity;

use App\Repository\GamesInfoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: GamesInfoRepository::class)]
#[Broadcast]
class GamesInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Dev = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Editor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Releasedate = null;

    #[ORM\Column(nullable: true)]
    private ?int $Price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Gender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PlatformGame = null;

    #[ORM\Column]
    private ?int $rating = null;

    #[ORM\Column(length: 255)]
    private ?string $LastModificationUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDev(): ?string
    {
        return $this->Dev;
    }

    public function setDev(?string $Dev): static
    {
        $this->Dev = $Dev;

        return $this;
    }

    public function getEditor(): ?string
    {
        return $this->Editor;
    }

    public function setEditor(?string $Editor): static
    {
        $this->Editor = $Editor;

        return $this;
    }

    public function getReleasedate(): ?string
    {
        return $this->Releasedate;
    }

    public function setReleasedate(?string $Releasedate): static
    {
        $this->Releasedate = $Releasedate;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(?int $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(?string $Gender): static
    {
        $this->Gender = $Gender;

        return $this;
    }

    public function getPlatformGame(): ?string
    {
        return $this->PlatformGame;
    }

    public function setPlatformGame(?string $PlatformGame): static
    {
        $this->PlatformGame = $PlatformGame;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getLastModificationUser(): ?string
    {
        return $this->LastModificationUser;
    }

    public function setLastModificationUser(string $LastModificationUser): static
    {
        $this->LastModificationUser = $LastModificationUser;

        return $this;
    }
}
