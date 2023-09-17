<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bandes_annonces_teasers = null;

    #[Vich\UploadableField(mapping: 'films', fileNameProperty: 'bandes_annonces_teasers')]
    private ?File $imageFile2 = null;

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

    #[ORM\ManyToMany(targetEntity: Artiste::class, mappedBy: 'film')]
    private Collection $artistes;

    // #[Vich\UploadableField(mapping: 'artistes', fileNameProperty: 'nom')]
    // private ?File $imageFile3 = null;

    #[ORM\OneToMany(mappedBy: 'film', targetEntity: Critique::class)]
    private Collection $critiques;

    #[ORM\OneToMany(mappedBy: 'film', targetEntity: Notation::class)]
    private Collection $notations;

    #[ORM\OneToMany(mappedBy: 'film', targetEntity: RoleArtisteFilm::class)]
    private Collection $roleArtisteFilms;

    #[ORM\OneToMany(mappedBy: 'film2', targetEntity: RoleArtisteFilm::class)]
    private Collection $producteur;

    #[ORM\OneToMany(mappedBy: 'film3', targetEntity: RoleArtisteFilm::class)]
    private Collection $compositeur;

    #[ORM\OneToMany(mappedBy: 'film4', targetEntity: RoleArtisteFilm::class)]
    private Collection $scenariste;

    #[ORM\OneToMany(mappedBy: 'film5', targetEntity: RoleArtisteFilm::class)]
    private Collection $casting;

    public function __construct()
    {
        $this->article = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->artistes = new ArrayCollection();
        $this->critiques = new ArrayCollection();
        $this->notations = new ArrayCollection();
        $this->roleArtisteFilms = new ArrayCollection();
        $this->producteur = new ArrayCollection();
        $this->compositeur = new ArrayCollection();
        $this->scenariste = new ArrayCollection();
        $this->casting = new ArrayCollection();
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

    public function getBandesAnnoncesTeasers(): ?string
    {
        return $this->bandes_annonces_teasers;
    }

    public function setBandesAnnoncesTeasers(string $bandes_annonces_teasers = null): static
    {
        $this->bandes_annonces_teasers = $bandes_annonces_teasers;

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
    public function setImageFile2(?File $imageFile2 = null): void
    {
        $this->imageFile2 = $imageFile2;

        if (null !== $imageFile2) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile2(): ?File
    {
        return $this->imageFile2;
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
            $artiste->addFilm($this);
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): static
    {
        if ($this->artistes->removeElement($artiste)) {
            $artiste->removeFilm($this);
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
            $roleArtisteFilm->setFilm($this);
        }

        return $this;
    }

    public function removeRoleArtisteFilm(RoleArtisteFilm $roleArtisteFilm): static
    {
        if ($this->roleArtisteFilms->removeElement($roleArtisteFilm)) {
            // set the owning side to null (unless already changed)
            if ($roleArtisteFilm->getFilm() === $this) {
                $roleArtisteFilm->setFilm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RoleArtisteFilm>
     */
    public function getProducteur(): Collection
    {
        return $this->producteur;
    }

    public function addProducteur(RoleArtisteFilm $producteur): static
    {
        if (!$this->producteur->contains($producteur)) {
            $this->producteur->add($producteur);
            $producteur->setFilm2($this);
        }

        return $this;
    }

    public function removeProducteur(RoleArtisteFilm $producteur): static
    {
        if ($this->producteur->removeElement($producteur)) {
            // set the owning side to null (unless already changed)
            if ($producteur->getFilm2() === $this) {
                $producteur->setFilm2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RoleArtisteFilm>
     */
    public function getCompositeur(): Collection
    {
        return $this->compositeur;
    }

    public function addCompositeur(RoleArtisteFilm $compositeur): static
    {
        if (!$this->compositeur->contains($compositeur)) {
            $this->compositeur->add($compositeur);
            $compositeur->setFilm3($this);
        }

        return $this;
    }

    public function removeCompositeur(RoleArtisteFilm $compositeur): static
    {
        if ($this->compositeur->removeElement($compositeur)) {
            // set the owning side to null (unless already changed)
            if ($compositeur->getFilm3() === $this) {
                $compositeur->setFilm3(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RoleArtisteFilm>
     */
    public function getScenariste(): Collection
    {
        return $this->scenariste;
    }

    public function addScenariste(RoleArtisteFilm $scenariste): static
    {
        if (!$this->scenariste->contains($scenariste)) {
            $this->scenariste->add($scenariste);
            $scenariste->setFilm4($this);
        }

        return $this;
    }

    public function removeScenariste(RoleArtisteFilm $scenariste): static
    {
        if ($this->scenariste->removeElement($scenariste)) {
            // set the owning side to null (unless already changed)
            if ($scenariste->getFilm4() === $this) {
                $scenariste->setFilm4(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RoleArtisteFilm>
     */
    public function getCasting(): Collection
    {
        return $this->casting;
    }

    public function addCasting(RoleArtisteFilm $casting): static
    {
        if (!$this->casting->contains($casting)) {
            $this->casting->add($casting);
            $casting->setFilm5($this);
        }

        return $this;
    }

    public function removeCasting(RoleArtisteFilm $casting): static
    {
        if ($this->casting->removeElement($casting)) {
            // set the owning side to null (unless already changed)
            if ($casting->getFilm5() === $this) {
                $casting->setFilm5(null);
            }
        }

        return $this;
    }
}
