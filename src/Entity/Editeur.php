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

    #[ORM\ManyToMany(targetEntity: Livre::class, mappedBy: 'editeur_pays_origine')]
    private Collection $editeurs_pays_origine_livres;

    #[ORM\ManyToMany(targetEntity: Livre::class, mappedBy: 'editeur_france')]
    private Collection $editeurs_france_livres;

    public function __construct()
    {
        $this->editeurs_pays_origine_livres = new ArrayCollection();
        $this->editeurs_france_livres = new ArrayCollection();
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
    public function getEditeursPaysOrigineLivres(): Collection
    {
        return $this->editeurs_pays_origine_livres;
    }

    public function addEditeursPaysOrigineLivre(Livre $editeursPaysOrigineLivre): static
    {
        if (!$this->editeurs_pays_origine_livres->contains($editeursPaysOrigineLivre)) {
            $this->editeurs_pays_origine_livres->add($editeursPaysOrigineLivre);
            $editeursPaysOrigineLivre->addEditeurPaysOrigine($this);
        }

        return $this;
    }

    public function removeEditeursPaysOrigineLivre(Livre $editeursPaysOrigineLivre): static
    {
        if ($this->editeurs_pays_origine_livres->removeElement($editeursPaysOrigineLivre)) {
            $editeursPaysOrigineLivre->removeEditeurPaysOrigine($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getEditeursFranceLivres(): Collection
    {
        return $this->editeurs_france_livres;
    }

    public function addEditeursFranceLivre(Livre $editeursFranceLivre): static
    {
        if (!$this->editeurs_france_livres->contains($editeursFranceLivre)) {
            $this->editeurs_france_livres->add($editeursFranceLivre);
            $editeursFranceLivre->addEditeurFrance($this);
        }

        return $this;
    }

    public function removeEditeursFranceLivre(Livre $editeursFranceLivre): static
    {
        if ($this->editeurs_france_livres->removeElement($editeursFranceLivre)) {
            $editeursFranceLivre->removeEditeurFrance($this);
        }

        return $this;
    }

}
