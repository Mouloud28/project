<?php

namespace App\Entity;

use App\Entity\Artiste;
use App\Entity\Editeur;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
#[Vich\Uploadable]

class Livre
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
    private ?string $couverture = null;

    #[Vich\UploadableField(mapping: 'livres', fileNameProperty: 'couverture')]
    private ?File $imageFile = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    #[ORM\Column(length: 255)]
    private ?string $pays_origine = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_publication_france = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_publication_pays_origine = null;

    #[ORM\Column(length: 255)]
    private ?string $ISBN = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'livre', targetEntity: Article::class)]
    private Collection $article;

    #[ORM\ManyToOne(inversedBy: 'livre')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(inversedBy: 'livre')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Forum $forum = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, mappedBy: 'livre')]
    private Collection $genres;

    #[ORM\ManyToOne(inversedBy: 'livre')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Langue $langue = null;

    #[ORM\ManyToMany(targetEntity: Artiste::class, mappedBy: 'livre')]
    private Collection $artistes;

    #[ORM\OneToMany(mappedBy: 'livre', targetEntity: Critique::class)]
    private Collection $critiques;

    #[ORM\OneToMany(mappedBy: 'livre', targetEntity: Notation::class)]
    private Collection $notations;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'livres')]
    private Collection $traducteurs;

    #[ORM\ManyToMany(targetEntity: Editeur::class, mappedBy: 'livres')]
    private Collection $editeurs_france;

    #[ORM\Column(length: 255)]
    private ?string $ISBN_france = null;

    #[ORM\ManyToMany(targetEntity: Editeur::class, inversedBy: 'livres_editeurs_pays_origine')]
    private Collection $editeurs_pays_origine;

    // #[ORM\Column(length: 255, nullable: true)]
    // private ?string $traducteur = null;

    public function __construct()
    {
        $this->article = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->artistes = new ArrayCollection();
        $this->critiques = new ArrayCollection();
        $this->notations = new ArrayCollection();
        $this->traducteurs = new ArrayCollection();
        $this->editeurs_france = new ArrayCollection();
        $this->editeurs_pays_origine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCouverture(): ?string
    {
        return $this->couverture;
    }

    public function setCouverture(string $couverture = null): static
    {
        $this->couverture = $couverture;

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

    public function getDatePublicationFrance(): ?\DateTimeInterface
    {
        return $this->date_publication_france;
    }

    public function setDatePublicationFrance(\DateTimeInterface $date_publication_france): static
    {
        $this->date_publication_france = $date_publication_france;

        return $this;
    }

    public function getDatePublicationPaysOrigine(): ?\DateTimeInterface
    {
        return $this->date_publication_pays_origine;
    }

    public function setDatePublicationPaysOrigine(\DateTimeInterface $date_publication_pays_origine): static
    {
        $this->date_publication_pays_origine = $date_publication_pays_origine;

        return $this;
    }

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(string $ISBN): static
    {
        $this->ISBN = $ISBN;

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
            $article->setLivre($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getLivre() === $this) {
                $article->setLivre(null);
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
            $genre->addLivre($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        if ($this->genres->removeElement($genre)) {
            $genre->removeLivre($this);
        }

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
            $artiste->addLivre($this);
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): static
    {
        if ($this->artistes->removeElement($artiste)) {
            $artiste->removeLivre($this);
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
            $critique->setLivre($this);
        }

        return $this;
    }

    public function removeCritique(Critique $critique): static
    {
        if ($this->critiques->removeElement($critique)) {
            // set the owning side to null (unless already changed)
            if ($critique->getLivre() === $this) {
                $critique->setLivre(null);
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
            $notation->setLivre($this);
        }

        return $this;
    }

    public function removeNotation(Notation $notation): static
    {
        if ($this->notations->removeElement($notation)) {
            // set the owning side to null (unless already changed)
            if ($notation->getLivre() === $this) {
                $notation->setLivre(null);
            }
        }

        return $this;
    }

    // public function getTraducteur(): ?string
    // {
    //     return $this->traducteur;
    // }

    // public function setTraducteur(?string $traducteur): static
    // {
    //     $this->traducteur = $traducteur;

    //     return $this;
    // }

    /**
     * @return Collection<int, Artiste>
     */
    public function getTraducteurs(): Collection
    {
        return $this->traducteurs;
    }

    public function addTraducteur(Artiste $traducteur): static
    {
        if (!$this->traducteurs->contains($traducteur)) {
            $this->traducteurs->add($traducteur);
        }

        return $this;
    }

    public function removeTraducteur(Artiste $traducteur): static
    {
        $this->traducteurs->removeElement($traducteur);

        return $this;
    }

    /**
     * @return Collection<int, Editeur>
     */
    public function getEditeursFrance(): Collection
    {
        return $this->editeurs_france;
    }

    public function addEditeurFrance(Editeur $editeur_france): static
    {
        if (!$this->editeurs_france->contains($editeur_france)) {
            $this->editeurs_france->add($editeur_france);
        }

        return $this;
    }

    public function removeEditeurFrance(Editeur $editeur_france): static
    {
        $this->editeurs_france->removeElement($editeur_france);

        return $this;
    }

    public function getISBNFrance(): ?string
    {
        return $this->ISBN_france;
    }

    public function setISBNFrance(string $ISBN_france): static
    {
        $this->ISBN_france = $ISBN_france;

        return $this;
    }

    /**
     * @return Collection<int, Editeur>
     */
    public function getEditeursPaysOrigine(): Collection
    {
        return $this->editeurs_pays_origine;
    }

    public function addEditeursPaysOrigine(Editeur $editeursPaysOrigine): static
    {
        if (!$this->editeurs_pays_origine->contains($editeursPaysOrigine)) {
            $this->editeurs_pays_origine->add($editeursPaysOrigine);
        }

        return $this;
    }

    public function removeEditeursPaysOrigine(Editeur $editeursPaysOrigine): static
    {
        $this->editeurs_pays_origine->removeElement($editeursPaysOrigine);

        return $this;
    }
}
