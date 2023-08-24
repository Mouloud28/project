<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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

    #[ORM\Column(length: 255)]
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

    public function setCouverture(string $couverture): static
    {
        $this->couverture = $couverture;

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
}
