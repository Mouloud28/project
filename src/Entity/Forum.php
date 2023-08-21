<?php

namespace App\Entity;

use App\Repository\ForumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumRepository::class)]
class Forum
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'forum', targetEntity: Livre::class, orphanRemoval: true)]
    private Collection $livre;

    #[ORM\OneToMany(mappedBy: 'forum', targetEntity: Film::class, orphanRemoval: true)]
    private Collection $film;

    #[ORM\OneToMany(mappedBy: 'forum', targetEntity: Serie::class, orphanRemoval: true)]
    private Collection $serie;

    #[ORM\OneToMany(mappedBy: 'forum', targetEntity: Album::class, orphanRemoval: true)]
    private Collection $album;

    #[ORM\OneToMany(mappedBy: 'forum', targetEntity: Sujet::class)]
    private Collection $sujet;

    #[ORM\OneToMany(mappedBy: 'forum', targetEntity: Categorie::class)]
    private Collection $categorie;

    public function __construct()
    {
        $this->livre = new ArrayCollection();
        $this->film = new ArrayCollection();
        $this->serie = new ArrayCollection();
        $this->album = new ArrayCollection();
        $this->sujet = new ArrayCollection();
        $this->categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Livre>
     */
    public function getLivre(): Collection
    {
        return $this->livre;
    }

    public function addLivre(Livre $livre): static
    {
        if (!$this->livre->contains($livre)) {
            $this->livre->add($livre);
            $livre->setForum($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): static
    {
        if ($this->livre->removeElement($livre)) {
            // set the owning side to null (unless already changed)
            if ($livre->getForum() === $this) {
                $livre->setForum(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilm(): Collection
    {
        return $this->film;
    }

    public function addFilm(Film $film): static
    {
        if (!$this->film->contains($film)) {
            $this->film->add($film);
            $film->setForum($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): static
    {
        if ($this->film->removeElement($film)) {
            // set the owning side to null (unless already changed)
            if ($film->getForum() === $this) {
                $film->setForum(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getSerie(): Collection
    {
        return $this->serie;
    }

    public function addSerie(Serie $serie): static
    {
        if (!$this->serie->contains($serie)) {
            $this->serie->add($serie);
            $serie->setForum($this);
        }

        return $this;
    }

    public function removeSerie(Serie $serie): static
    {
        if ($this->serie->removeElement($serie)) {
            // set the owning side to null (unless already changed)
            if ($serie->getForum() === $this) {
                $serie->setForum(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getAlbum(): Collection
    {
        return $this->album;
    }

    public function addAlbum(Album $album): static
    {
        if (!$this->album->contains($album)) {
            $this->album->add($album);
            $album->setForum($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): static
    {
        if ($this->album->removeElement($album)) {
            // set the owning side to null (unless already changed)
            if ($album->getForum() === $this) {
                $album->setForum(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sujet>
     */
    public function getSujet(): Collection
    {
        return $this->sujet;
    }

    public function addSujet(Sujet $sujet): static
    {
        if (!$this->sujet->contains($sujet)) {
            $this->sujet->add($sujet);
            $sujet->setForum($this);
        }

        return $this;
    }

    public function removeSujet(Sujet $sujet): static
    {
        if ($this->sujet->removeElement($sujet)) {
            // set the owning side to null (unless already changed)
            if ($sujet->getForum() === $this) {
                $sujet->setForum(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): static
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
            $categorie->setForum($this);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): static
    {
        if ($this->categorie->removeElement($categorie)) {
            // set the owning side to null (unless already changed)
            if ($categorie->getForum() === $this) {
                $categorie->setForum(null);
            }
        }

        return $this;
    }
}
