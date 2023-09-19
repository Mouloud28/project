<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
#[Vich\Uploadable]

class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $pays_origine = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[Vich\UploadableField(mapping: 'artistes', fileNameProperty: 'photo')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Serie::class, inversedBy: 'artistes')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $serie;

    #[ORM\ManyToMany(targetEntity: Album::class, inversedBy: 'compositeurs')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $album;

    #[ORM\ManyToMany(targetEntity: Livre::class, inversedBy: 'artistes')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $livre;

    #[ORM\ManyToOne(inversedBy: 'artistes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ville $ville = null;

    #[ORM\ManyToMany(targetEntity: Metier::class, mappedBy: 'artiste')]
    private Collection $metiers;

    #[ORM\ManyToMany(targetEntity: Livre::class, mappedBy: 'traducteurs')]
    private Collection $livres;

    #[ORM\ManyToMany(targetEntity: Album::class, mappedBy: 'producteurs')]
    private Collection $albums;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'realisateur')]
    private Collection $realisateurs_films;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'producteur')]
    private Collection $producteurs_films;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'scenariste')]
    private Collection $scenaristes_films;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'casting')]
    private Collection $casting_film;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'compositeur')]
    private Collection $compositeurs_films;

    public function __construct()
    {
        $this->serie = new ArrayCollection();
        $this->album = new ArrayCollection();
        $this->livre = new ArrayCollection();
        $this->metiers = new ArrayCollection();
        $this->livres = new ArrayCollection();
        $this->albums = new ArrayCollection();
        $this->realisateurs_films = new ArrayCollection();
        $this->producteurs_films = new ArrayCollection();
        $this->scenaristes_films = new ArrayCollection();
        $this->casting_film = new ArrayCollection();
        $this->compositeurs_films = new ArrayCollection();
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

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getPaysOrigine(): ?string
    {
        return $this->pays_origine;
    }

    public function setPaysOrigine(string $pays_origine): static
    {
        $this->pays_origine = $pays_origine;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo = null): static
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
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
        }

        return $this;
    }

    public function removeSerie(Serie $serie): static
    {
        $this->serie->removeElement($serie);

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
        }

        return $this;
    }

    public function removeAlbum(Album $album): static
    {
        $this->album->removeElement($album);

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
        }

        return $this;
    }

    public function removeLivre(Livre $livre): static
    {
        $this->livre->removeElement($livre);

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Metier>
     */
    public function getMetiers(): Collection
    {
        return $this->metiers;
    }

    public function addMetier(Metier $metier): static
    {
        if (!$this->metiers->contains($metier)) {
            $this->metiers->add($metier);
            $metier->addArtiste($this);
        }

        return $this;
    }

    public function removeMetier(Metier $metier): static
    {
        if ($this->metiers->removeElement($metier)) {
            $metier->removeArtiste($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getRealisateursFilms(): Collection
    {
        return $this->realisateurs_films;
    }

    public function addRealisateursFilm(Film $realisateursFilm): static
    {
        if (!$this->realisateurs_films->contains($realisateursFilm)) {
            $this->realisateurs_films->add($realisateursFilm);
            $realisateursFilm->addRealisateur($this);
        }

        return $this;
    }

    public function removeRealisateursFilm(Film $realisateursFilm): static
    {
        if ($this->realisateurs_films->removeElement($realisateursFilm)) {
            $realisateursFilm->removeRealisateur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getProducteursFilms(): Collection
    {
        return $this->producteurs_films;
    }

    public function addProducteursFilm(Film $producteursFilm): static
    {
        if (!$this->producteurs_films->contains($producteursFilm)) {
            $this->producteurs_films->add($producteursFilm);
            $producteursFilm->addProducteur($this);
        }

        return $this;
    }

    public function removeProducteursFilm(Film $producteursFilm): static
    {
        if ($this->producteurs_films->removeElement($producteursFilm)) {
            $producteursFilm->removeProducteur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getScenaristesFilms(): Collection
    {
        return $this->scenaristes_films;
    }

    public function addScenaristesFilm(Film $scenaristesFilm): static
    {
        if (!$this->scenaristes_films->contains($scenaristesFilm)) {
            $this->scenaristes_films->add($scenaristesFilm);
            $scenaristesFilm->addScenariste($this);
        }

        return $this;
    }

    public function removeScenaristesFilm(Film $scenaristesFilm): static
    {
        if ($this->scenaristes_films->removeElement($scenaristesFilm)) {
            $scenaristesFilm->removeScenariste($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getCastingFilm(): Collection
    {
        return $this->casting_film;
    }

    public function addCastingFilm(Film $castingFilm): static
    {
        if (!$this->casting_film->contains($castingFilm)) {
            $this->casting_film->add($castingFilm);
            $castingFilm->addCasting($this);
        }

        return $this;
    }

    public function removeCastingFilm(Film $castingFilm): static
    {
        if ($this->casting_film->removeElement($castingFilm)) {
            $castingFilm->removeCasting($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getCompositeursFilms(): Collection
    {
        return $this->compositeurs_films;
    }

    public function addCompositeursFilm(Film $compositeursFilm): static
    {
        if (!$this->compositeurs_films->contains($compositeursFilm)) {
            $this->compositeurs_films->add($compositeursFilm);
            $compositeursFilm->addCompositeur($this);
        }

        return $this;
    }

    public function removeCompositeursFilm(Film $compositeursFilm): static
    {
        if ($this->compositeurs_films->removeElement($compositeursFilm)) {
            $compositeursFilm->removeCompositeur($this);
        }

        return $this;
    }
}
