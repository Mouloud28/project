<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AlbumRepository;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
#[Vich\Uploadable]

class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_francais = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_original = null;

    #[ORM\Column(length: 255)]
    private ?string $affiche = null;

    #[Vich\UploadableField(mapping: 'albums', fileNameProperty: 'affiche')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255)]
    private ?string $pays_origine = null;

    #[ORM\Column(length: 255)]
    private ?string $track = null;

    #[ORM\Column(length: 255)]
    private ?string $single = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_enregistrement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_sortie_france = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_sortie_pays_origine = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Article::class)]
    private Collection $article;

    #[ORM\ManyToOne(inversedBy: 'album')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'album')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Forum $forum = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, mappedBy: 'album')]
    private Collection $genres;

    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Critique::class)]
    private Collection $critiques;

    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Notation::class)]
    private Collection $notations;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'compositeurs_albums')]
    #[JoinTable(name: 'compositeurs_artistes3')]
    private Collection $compositeur;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'producteurs_albums')]
    #[JoinTable(name: 'producteurs_artistes3')]
    private Collection $producteur;

    public function __construct()
    {
        $this->article = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->critiques = new ArrayCollection();
        $this->notations = new ArrayCollection();
        $this->compositeur = new ArrayCollection();
        $this->producteur = new ArrayCollection();
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

    public function setAffiche(string $affiche): static
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

    public function getPaysOrigine(): ?string
    {
        return $this->pays_origine;
    }

    public function setPaysOrigine(string $pays_origine): static
    {
        $this->pays_origine = $pays_origine;

        return $this;
    }

    public function getTrack(): ?string
    {
        return $this->track;
    }

    public function setTrack(string $track): static
    {
        $this->track = $track;

        return $this;
    }

    public function getSingle(): ?string
    {
        return $this->single;
    }

    public function setSingle(string $single): static
    {
        $this->single = $single;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $date_enregistrement): static
    {
        $this->date_enregistrement = $date_enregistrement;

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

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
            $article->setAlbum($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getAlbum() === $this) {
                $article->setAlbum(null);
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
            $genre->addAlbum($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeAlbum($this);
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
            $critique->setAlbum($this);
        }

        return $this;
    }

    public function removeCritique(Critique $critique): static
    {
        if ($this->critiques->removeElement($critique)) {
            // set the owning side to null (unless already changed)
            if ($critique->getAlbum() === $this) {
                $critique->setAlbum(null);
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
            $notation->setAlbum($this);
        }

        return $this;
    }

    public function removeNotation(Notation $notation): static
    {
        if ($this->notations->removeElement($notation)) {
            // set the owning side to null (unless already changed)
            if ($notation->getAlbum() === $this) {
                $notation->setAlbum(null);
            }
        }

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

}
