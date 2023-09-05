<?php

namespace App\Entity;

use App\Repository\EditeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditeurRepository::class)]
class Editeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $pays_origine = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Livre::class, inversedBy: 'editeurs_pays_origine')]
    #[ORM\JoinColumn(nullable: false)]
   
    private Collection $livres;

    #[ORM\ManyToMany(targetEntity: Livre::class, mappedBy: 'editeurs_france')]
    private Collection $livres2;

    public function __construct()
    {
        $this->livres = new ArrayCollection();
        $this->livres2 = new ArrayCollection();
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

    public function getPaysOrigine(): ?string
    {
        return $this->pays_origine;
    }

    public function setPaysOrigine(string $pays_origine): static
    {
        $this->pays_origine = $pays_origine;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

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
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): static
    {
        if (!$this->livres->contains($livre)) {
            $this->livres->add($livre);
            $livre->addEditeursPaysOrigine($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): static
    {
        if ($this->livres->removeElement($livre)) {
            $livre->removeEditeursPaysOrigine($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getLivres2(): Collection
    {
        return $this->livres2;
    }

    public function addLivres2(Livre $livres2): static
    {
        if (!$this->livres2->contains($livres2)) {
            $this->livres2->add($livres2);
            $livres2->addEditeursFrance($this);
        }

        return $this;
    }

    public function removeLivres2(Livre $livres2): static
    {
        if ($this->livres2->removeElement($livres2)) {
            $livres2->removeEditeursFrance($this);
        }

        return $this;
    }

}
