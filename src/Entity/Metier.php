<?php

namespace App\Entity;

use App\Repository\MetierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetierRepository::class)]
class Metier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'metiers')]
    private Collection $artiste;

    #[ORM\ManyToMany(targetEntity: RoleArtisteFilm::class, mappedBy: 'role')]
    private Collection $roleArtisteFilms;

    public function __construct()
    {
        $this->artiste = new ArrayCollection();
        $this->roleArtisteFilms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getArtiste(): Collection
    {
        return $this->artiste;
    }

    public function addArtiste(Artiste $artiste): static
    {
        if (!$this->artiste->contains($artiste)) {
            $this->artiste->add($artiste);
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): static
    {
        $this->artiste->removeElement($artiste);

        return $this;
    }

    /**
     * @return Collection<int, RoleArtisteFilm>
     */
    public function getRoleArtisteFilms(): Collection
    {
        return $this->roleArtisteFilms;
    }

    public function addRoleArtisteFilm(RoleArtisteFilm $roleArtisteFilm): static
    {
        if (!$this->roleArtisteFilms->contains($roleArtisteFilm)) {
            $this->roleArtisteFilms->add($roleArtisteFilm);
            $roleArtisteFilm->addRole($this);
        }

        return $this;
    }

    public function removeRoleArtisteFilm(RoleArtisteFilm $roleArtisteFilm): static
    {
        if ($this->roleArtisteFilms->removeElement($roleArtisteFilm)) {
            $roleArtisteFilm->removeRole($this);
        }

        return $this;
    }

}
