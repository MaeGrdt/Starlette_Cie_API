<?php

namespace App\Entity;

use App\Enum\AffinageEnum;
use App\Enum\StockEnum;
use App\Repository\ProduitsVariantsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsVariantsRepository::class)]
class ProduitsVariants
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer', name: 'id_variant')]
    private ?int $id_variant = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $poids = null;

    #[ORM\Column(length: 50)]
    private ?AffinageEnum $affinage = null;

    #[ORM\Column(length: 50)]
    private ?StockEnum $stock = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $composition = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_ajout = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false, name: 'id_produit', referencedColumnName: 'id_produit')]
    private ?Produit $id_produit = null;

    #[ORM\OneToOne(targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_image', referencedColumnName: 'id_image')]
    private ?Image $id_image = null;

    #[ORM\ManyToOne(inversedBy: 'produits_enrobage')]
    #[ORM\JoinColumn(nullable: false, name: 'id_enrobage', referencedColumnName: 'id_enrobage')]
    private ?Enrobage $id_enrobage = null;

    public function getId(): ?int
    {
        return $this->id_variant;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): static
    {
        $this->poids = $poids;

        return $this;
    }

    public function getAffinage(): ?AffinageEnum
    {
        return $this->affinage;
    }

    public function setAffinage(AffinageEnum $affinage): static
    {
        $this->affinage = $affinage;

        return $this;
    }

    public function getStock(): ?StockEnum
    {
        return $this->stock;
    }

    public function setStock(StockEnum $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getComposition(): ?string
    {
        return $this->composition;
    }

    public function setComposition(string $composition): static
    {
        $this->composition = $composition;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->date_ajout;
    }

    public function setDateAjout(\DateTimeInterface $date_ajout): static
    {
        $this->date_ajout = $date_ajout;

        return $this;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->id_produit;
    }

    public function setIdProduit(?Produit $id_produit): static
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getIdImage(): ?Image
    {
        return $this->id_image;
    }

    public function setIdImage(?Image $id_image): static
    {
        $this->id_image = $id_image;

        return $this;
    }

    public function getIdEnrobage(): ?Enrobage
    {
        return $this->id_enrobage;
    }

    public function setIdEnrobage(?Enrobage $id_enrobage): static
    {
        $this->id_enrobage = $id_enrobage;

        return $this;
    }
}
