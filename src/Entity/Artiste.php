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

    #[ORM\ManyToOne(inversedBy: 'artistes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ville $ville = null;

    #[ORM\ManyToMany(targetEntity: Metier::class, mappedBy: 'artiste')]
    private Collection $metiers;

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

    #[ORM\ManyToMany(targetEntity: Livre::class, mappedBy: 'auteur')]
    private Collection $auteurs_livres;

    #[ORM\ManyToMany(targetEntity: Livre::class, mappedBy: 'traducteur')]
    private Collection $traducteurs_livres;

    #[ORM\ManyToMany(targetEntity: Serie::class, mappedBy: 'createur')]
    private Collection $createurs_series;

    #[ORM\ManyToMany(targetEntity: Serie::class, mappedBy: 'producteur')]
    private Collection $producteurs_series;

    #[ORM\ManyToMany(targetEntity: Serie::class, mappedBy: 'scenariste')]
    private Collection $scenaristes_series;

    #[ORM\ManyToMany(targetEntity: Serie::class, mappedBy: 'casting')]
    private Collection $casting_serie;

    #[ORM\ManyToMany(targetEntity: Serie::class, mappedBy: 'compositeur')]
    private Collection $compositeurs_series;

    #[ORM\ManyToMany(targetEntity: Livre::class, mappedBy: 'artistes')]
    private Collection $livres;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'artistes')]
    private Collection $films;

    #[ORM\ManyToMany(targetEntity: Serie::class, mappedBy: 'artistes')]
    private Collection $series;

    #[ORM\ManyToMany(targetEntity: Album::class, mappedBy: 'compositeur')]
    private Collection $compositeurs_albums;

    #[ORM\ManyToMany(targetEntity: Album::class, mappedBy: 'producteur')]
    private Collection $producteurs_albums;

    #[ORM\Column(length: 255)]
    private ?string $presentation = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $date_deces = null;

    public function __construct()
    {
        $this->metiers = new ArrayCollection();
        $this->realisateurs_films = new ArrayCollection();
        $this->producteurs_films = new ArrayCollection();
        $this->scenaristes_films = new ArrayCollection();
        $this->casting_film = new ArrayCollection();
        $this->compositeurs_films = new ArrayCollection();
        $this->auteurs_livres = new ArrayCollection();
        $this->traducteurs_livres = new ArrayCollection();
        $this->createurs_series = new ArrayCollection();
        $this->producteurs_series = new ArrayCollection();
        $this->scenaristes_series = new ArrayCollection();
        $this->casting_serie = new ArrayCollection();
        $this->compositeurs_series = new ArrayCollection();
        $this->livres = new ArrayCollection();
        $this->films = new ArrayCollection();
        $this->series = new ArrayCollection();
        $this->compositeurs_albums = new ArrayCollection();
        $this->producteurs_albums = new ArrayCollection();
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

    /**
     * @return Collection<int, Livre>
     */
    public function getAuteursLivres(): Collection
    {
        return $this->auteurs_livres;
    }

    public function addAuteursLivre(Livre $auteursLivre): static
    {
        if (!$this->auteurs_livres->contains($auteursLivre)) {
            $this->auteurs_livres->add($auteursLivre);
            $auteursLivre->addAuteur($this);
        }

        return $this;
    }

    public function removeAuteursLivre(Livre $auteursLivre): static
    {
        if ($this->auteurs_livres->removeElement($auteursLivre)) {
            $auteursLivre->removeAuteur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getTraducteursLivres(): Collection
    {
        return $this->traducteurs_livres;
    }

    public function addTraducteursLivre(Livre $traducteursLivre): static
    {
        if (!$this->traducteurs_livres->contains($traducteursLivre)) {
            $this->traducteurs_livres->add($traducteursLivre);
            $traducteursLivre->addTraducteur($this);
        }

        return $this;
    }

    public function removeTraducteursLivre(Livre $traducteursLivre): static
    {
        if ($this->traducteurs_livres->removeElement($traducteursLivre)) {
            $traducteursLivre->removeTraducteur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getCreateursSeries(): Collection
    {
        return $this->createurs_series;
    }

    public function addCreateursSeries(Serie $createursSeries): static
    {
        if (!$this->createurs_series->contains($createursSeries)) {
            $this->createurs_series->add($createursSeries);
            $createursSeries->addCreateur($this);
        }

        return $this;
    }

    public function removeCreateursSeries(Serie $createursSeries): static
    {
        if ($this->createurs_series->removeElement($createursSeries)) {
            $createursSeries->removeCreateur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getProducteursSeries(): Collection
    {
        return $this->producteurs_series;
    }

    public function addProducteursSeries(Serie $producteursSeries): static
    {
        if (!$this->producteurs_series->contains($producteursSeries)) {
            $this->producteurs_series->add($producteursSeries);
            $producteursSeries->addProducteur($this);
        }

        return $this;
    }

    public function removeProducteursSeries(Serie $producteursSeries): static
    {
        if ($this->producteurs_series->removeElement($producteursSeries)) {
            $producteursSeries->removeProducteur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getScenaristesSeries(): Collection
    {
        return $this->scenaristes_series;
    }

    public function addScenaristesSeries(Serie $scenaristesSeries): static
    {
        if (!$this->scenaristes_series->contains($scenaristesSeries)) {
            $this->scenaristes_series->add($scenaristesSeries);
            $scenaristesSeries->addScenariste($this);
        }

        return $this;
    }

    public function removeScenaristesSeries(Serie $scenaristesSeries): static
    {
        if ($this->scenaristes_series->removeElement($scenaristesSeries)) {
            $scenaristesSeries->removeScenariste($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getCastingSerie(): Collection
    {
        return $this->casting_serie;
    }

    public function addCastingSerie(Serie $castingSerie): static
    {
        if (!$this->casting_serie->contains($castingSerie)) {
            $this->casting_serie->add($castingSerie);
            $castingSerie->addCasting($this);
        }

        return $this;
    }

    public function removeCastingSerie(Serie $castingSerie): static
    {
        if ($this->casting_serie->removeElement($castingSerie)) {
            $castingSerie->removeCasting($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getCompositeursSeries(): Collection
    {
        return $this->compositeurs_series;
    }

    public function addCompositeursSeries(Serie $compositeursSeries): static
    {
        if (!$this->compositeurs_series->contains($compositeursSeries)) {
            $this->compositeurs_series->add($compositeursSeries);
            $compositeursSeries->addCompositeur($this);
        }

        return $this;
    }

    public function removeCompositeursSeries(Serie $compositeursSeries): static
    {
        if ($this->compositeurs_series->removeElement($compositeursSeries)) {
            $compositeursSeries->removeCompositeur($this);
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

    public function addLivre(Livre $livre): static
    {
        if (!$this->livres->contains($livre)) {
            $this->livres->add($livre);
            $livre->addArtiste($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): static
    {
        if ($this->livres->removeElement($livre)) {
            $livre->removeArtiste($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Film $film): static
    {
        if (!$this->films->contains($film)) {
            $this->films->add($film);
            $film->addArtiste($this);
        }

        return $this;
    }

    public function removeFilm(Film $film): static
    {
        if ($this->films->removeElement($film)) {
            $film->removeArtiste($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSeries(Serie $series): static
    {
        if (!$this->series->contains($series)) {
            $this->series->add($series);
            $series->addArtiste($this);
        }

        return $this;
    }

    public function removeSeries(Serie $series): static
    {
        if ($this->series->removeElement($series)) {
            $series->removeArtiste($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getCompositeursAlbums(): Collection
    {
        return $this->compositeurs_albums;
    }

    public function addCompositeursAlbum(Album $compositeursAlbum): static
    {
        if (!$this->compositeurs_albums->contains($compositeursAlbum)) {
            $this->compositeurs_albums->add($compositeursAlbum);
            $compositeursAlbum->addCompositeur($this);
        }

        return $this;
    }

    public function removeCompositeursAlbum(Album $compositeursAlbum): static
    {
        if ($this->compositeurs_albums->removeElement($compositeursAlbum)) {
            $compositeursAlbum->removeCompositeur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getProducteursAlbums(): Collection
    {
        return $this->producteurs_albums;
    }

    public function addProducteursAlbum(Album $producteursAlbum): static
    {
        if (!$this->producteurs_albums->contains($producteursAlbum)) {
            $this->producteurs_albums->add($producteursAlbum);
            $producteursAlbum->addProducteur($this);
        }

        return $this;
    }

    public function removeProducteursAlbum(Album $producteursAlbum): static
    {
        if ($this->producteurs_albums->removeElement($producteursAlbum)) {
            $producteursAlbum->removeProducteur($this);
        }

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getDateDeces(): ?\DateTimeImmutable
    {
        return $this->date_deces;
    }

    public function setDateDeces(?\DateTimeImmutable $date_deces): static
    {
        $this->date_deces = $date_deces;

        return $this;
    }
}
