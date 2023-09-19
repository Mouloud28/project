<?php

namespace App\Entity;

use App\Repository\RoleArtisteFilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleArtisteFilmRepository::class)]
class RoleArtisteFilm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'roleArtisteFilms')]
    private ?Artiste $artiste = null;

    #[ORM\ManyToOne(inversedBy: 'roleArtisteFilms')]
    private ?Film $film = null;

    #[ORM\ManyToOne(inversedBy: 'producteur')]
    private ?Film $film2 = null;

    #[ORM\ManyToOne(inversedBy: 'compositeur')]
    private ?Film $film3 = null;

    #[ORM\ManyToOne(inversedBy: 'scenariste')]
    private ?Film $film4 = null;

    #[ORM\ManyToOne(inversedBy: 'casting')]
    private ?Film $film5 = null;

    #[ORM\ManyToMany(targetEntity: Metier::class, inversedBy: 'roleArtisteFilms')]
    private Collection $role;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->role = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->role;
    }

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): static
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): static
    {
        $this->film = $film;

        return $this;
    }

    public function getFilm2(): ?Film
    {
        return $this->film2;
    }

    public function setFilm2(?Film $film2): static
    {
        $this->film2 = $film2;

        return $this;
    }

    public function getFilm3(): ?Film
    {
        return $this->film3;
    }

    public function setFilm3(?Film $film3): static
    {
        $this->film3 = $film3;

        return $this;
    }

    public function getFilm4(): ?Film
    {
        return $this->film4;
    }

    public function setFilm4(?Film $film4): static
    {
        $this->film4 = $film4;

        return $this;
    }

    public function getFilm5(): ?Film
    {
        return $this->film5;
    }

    public function setFilm5(?Film $film5): static
    {
        $this->film5 = $film5;

        return $this;
    }

    /**
     * @return Collection<int, Metier>
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(Metier $role): static
    {
        if (!$this->role->contains($role)) {
            $this->role->add($role);
        }

        return $this;
    }

    public function removeRole(Metier $role): static
    {
        $this->role->removeElement($role);

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
