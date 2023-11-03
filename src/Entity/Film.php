<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FilmRepository;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
#[Vich\Uploadable]

class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_francais = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_original = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $affiche = null;

    #[Vich\UploadableField(mapping: 'films', fileNameProperty: 'affiche')]
    private ?File $imageFile = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $duree = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    #[ORM\Column(length: 255)]
    private ?string $pays_origine = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_sortie_france = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_sortie_pays_origine = null;

    // #[ORM\Column(length: 255, nullable: true)]
    // private ?string $bandes_annonces_teasers = null;

    // #[Vich\UploadableField(mapping: 'films', fileNameProperty: 'bandes_annonces_teasers')]
    // private ?File $imageFile2 = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'film', targetEntity: Article::class)]
    private Collection $article;

    #[ORM\ManyToOne(inversedBy: 'film')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'film')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Forum $forum = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, mappedBy: 'film')]
    private Collection $genres;

    #[ORM\OneToMany(mappedBy: 'film', targetEntity: Critique::class)]
    private Collection $critiques;

    #[ORM\OneToMany(mappedBy: 'film', targetEntity: Notation::class)]
    private Collection $notations;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'realisateurs_films')]
    #[JoinTable(name: 'realisateurs_artistes')]
    private Collection $realisateur;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'producteurs_films')]
    #[JoinTable(name: 'producteurs_artistes')]
    private Collection $producteur;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'scenaristes_films')]
    #[JoinTable(name: 'scenaristes_artistes')]
    private Collection $scenariste;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'casting_film')]
    #[JoinTable(name: 'casting_artiste')]
    private Collection $casting;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'compositeurs_films')]
    #[JoinTable(name: 'compositeurs_artistes')]
    private Collection $compositeur;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'films')]
    private Collection $artistes;

    #[ORM\ManyToOne(inversedBy: 'films')]
    private ?Langue $langue = null;

    #[ORM\OneToMany(mappedBy: 'film', targetEntity: BandesAnnoncesTeasers::class, orphanRemoval: true, cascade:['persist', 'remove'])]
    private Collection $bandesAnnoncesTeasers;

    public function __construct()
    {
        $this->article = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->critiques = new ArrayCollection();
        $this->notations = new ArrayCollection();
        $this->realisateur = new ArrayCollection();
        $this->producteur = new ArrayCollection();
        $this->scenariste = new ArrayCollection();
        $this->casting = new ArrayCollection();
        $this->compositeur = new ArrayCollection();
        $this->artistes = new ArrayCollection();
        $this->bandesAnnoncesTeasers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->titre_francais;
    }

    public function getTitreFrancais(): ?string
    {
        return $this->titre_francais;
    }

    public function setTitreFrancais(string $titre_francais): static
    {
        $this->titre_francais = $titre_francais;

        return $this;
    }

    public function getTitreOriginal(): ?string
    {
        return $this->titre_original;
    }

    public function setTitreOriginal(string $titre_original): static
    {
        $this->titre_original = $titre_original;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(string $affiche = null): static
    {
        $this->affiche = $affiche;

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

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): static
    {
        $this->synopsis = $synopsis;

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

    public function getDateSortieFrance(): ?\DateTimeInterface
    {
        return $this->date_sortie_france;
    }

    public function setDateSortieFrance(\DateTimeInterface $date_sortie_france): static
    {
        $this->date_sortie_france = $date_sortie_france;

        return $this;
    }

    public function getDateSortiePaysOrigine(): ?\DateTimeInterface
    {
        return $this->date_sortie_pays_origine;
    }

    public function setDateSortiePaysOrigine(\DateTimeInterface $date_sortie_pays_origine): static
    {
        $this->date_sortie_pays_origine = $date_sortie_pays_origine;

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
     * @return Collection<int, Article>
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->article->contains($article)) {
            $this->article->add($article);
            $article->setFilm($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getFilm() === $this) {
                $article->setFilm(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getForum(): ?Forum
    {
        return $this->forum;
    }

    public function setForum(?Forum $forum): static
    {
        $this->forum = $forum;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
            $genre->addFilm($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeFilm($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Critique>
     */
    public function getCritiques(): Collection
    {
        return $this->critiques;
    }

    public function addCritique(Critique $critique): static
    {
        if (!$this->critiques->contains($critique)) {
            $this->critiques->add($critique);
            $critique->setFilm($this);
        }

        return $this;
    }

    public function removeCritique(Critique $critique): static
    {
        if ($this->critiques->removeElement($critique)) {
            // set the owning side to null (unless already changed)
            if ($critique->getFilm() === $this) {
                $critique->setFilm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Notation>
     */
    public function getNotations(): Collection
    {
        return $this->notations;
    }

    public function addNotation(Notation $notation): static
    {
        if (!$this->notations->contains($notation)) {
            $this->notations->add($notation);
            $notation->setFilm($this);
        }

        return $this;
    }

    public function removeNotation(Notation $notation): static
    {
        if ($this->notations->removeElement($notation)) {
            // set the owning side to null (unless already changed)
            if ($notation->getFilm() === $this) {
                $notation->setFilm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getRealisateur(): Collection
    {
        return $this->realisateur;
    }

    public function addRealisateur(Artiste $realisateur): static
    {
        if (!$this->realisateur->contains($realisateur)) {
            $this->realisateur->add($realisateur);
        }

        return $this;
    }

    public function removeRealisateur(Artiste $realisateur): static
    {
        $this->realisateur->removeElement($realisateur);

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getProducteur(): Collection
    {
        return $this->producteur;
    }

    public function addProducteur(Artiste $producteur): static
    {
        if (!$this->producteur->contains($producteur)) {
            $this->producteur->add($producteur);
        }

        return $this;
    }

    public function removeProducteur(Artiste $producteur): static
    {
        $this->producteur->removeElement($producteur);

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getScenariste(): Collection
    {
        return $this->scenariste;
    }

    public function addScenariste(Artiste $scenariste): static
    {
        if (!$this->scenariste->contains($scenariste)) {
            $this->scenariste->add($scenariste);
        }

        return $this;
    }

    public function removeScenariste(Artiste $scenariste): static
    {
        $this->scenariste->removeElement($scenariste);

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getCasting(): Collection
    {
        return $this->casting;
    }

    public function addCasting(Artiste $casting): static
    {
        if (!$this->casting->contains($casting)) {
            $this->casting->add($casting);
        }

        return $this;
    }

    public function removeCasting(Artiste $casting): static
    {
        $this->casting->removeElement($casting);

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getCompositeur(): Collection
    {
        return $this->compositeur;
    }

    public function addCompositeur(Artiste $compositeur): static
    {
        if (!$this->compositeur->contains($compositeur)) {
            $this->compositeur->add($compositeur);
        }

        return $this;
    }

    public function removeCompositeur(Artiste $compositeur): static
    {
        $this->compositeur->removeElement($compositeur);

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getArtistes(): Collection
    {
        return $this->artistes;
    }

    public function addArtiste(Artiste $artiste): static
    {
        if (!$this->artistes->contains($artiste)) {
            $this->artistes->add($artiste);
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): static
    {
        $this->artistes->removeElement($artiste);

        return $this;
    }

    public function getLangue(): ?Langue
    {
        return $this->langue;
    }

    public function setLangue(?Langue $langue): static
    {
        $this->langue = $langue;

        return $this;
    }

        /**
     * Get the value of bandesAnnoncesTeasers
     */ 
    public function getBandesAnnoncesTeasers()
    {
        return $this->bandesAnnoncesTeasers;
    }

    public function addBandesAnnoncesTeaser(BandesAnnoncesTeasers $bandesAnnoncesTeaser): static
    {
        if (!$this->bandesAnnoncesTeasers->contains($bandesAnnoncesTeaser)) {
            $this->bandesAnnoncesTeasers->add($bandesAnnoncesTeaser);
            $bandesAnnoncesTeaser->setFilm($this);
        }

        return $this;
    }

    public function removeBandesAnnoncesTeaser(BandesAnnoncesTeasers $bandesAnnoncesTeaser): static
    {
        if ($this->bandesAnnoncesTeasers->removeElement($bandesAnnoncesTeaser)) {
            // set the owning side to null (unless already changed)
            if ($bandesAnnoncesTeaser->getFilm() === $this) {
                $bandesAnnoncesTeaser->setFilm(null);
            }
        }

        return $this;
    }

}
