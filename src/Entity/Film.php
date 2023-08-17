<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
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

    #[ORM\Column(length: 255)]
    private ?string $affiche = null;

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

    #[ORM\Column(length: 255)]
    private ?string $bandes_annonces_teasers = null;

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

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(string $affiche): static
    {
        $this->affiche = $affiche;

        return $this;
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

    public function setBandesAnnoncesTeasers(string $bandes_annonces_teasers): static
    {
        $this->bandes_annonces_teasers = $bandes_annonces_teasers;

        return $this;
    }
}
