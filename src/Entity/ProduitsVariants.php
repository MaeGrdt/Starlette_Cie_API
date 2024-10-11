<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProduitsVariantsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitsVariantsRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext: ['groups' => ['variants.index', 'variants.details']],
    denormalizationContext: ['groups' => ['variants.create']],
)]
class ProduitsVariants
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer', name: 'id_variant')]
    #[Groups(['variants.index', 'variants.create'])]
    private ?int $id_variant = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type(type: 'integer')]
    #[Groups(['variants.index', 'variants.create'])]
    private ?int $prix = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Type(type: 'integer')]
    #[Groups(['variants.index', 'variants.create'])]
    private ?int $poids = null;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank]
    #[Groups(['variants.index', 'variants.create'])]
    private ?string $affinage = null;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank]
    #[Groups(['variants.index', 'variants.create'])]
    private ?string $stock = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Groups(['variants.index', 'variants.create'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Groups(['variants.index', 'variants.create'])]
    private ?string $composition = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['variants.index'])]
    private ?\DateTimeInterface $date_ajout = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false, name: 'id_produit', referencedColumnName: 'id_produit')]
    #[Assert\NotNull]
    #[Groups(['variants.index', 'variants.create'])]
    private ?Produit $id_produit = null;

    #[ORM\OneToOne(targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_image', referencedColumnName: 'id_image')]
    private ?Image $id_image = null;

    // #[ORM\ManyToOne(inversedBy: 'produits_enrobage')]
    // #[ORM\JoinColumn(nullable: false, name: 'id_enrobage', referencedColumnName: 'id_enrobage')]
    // #[Assert\NotNull]
    // #[Groups(['variants.index', 'variants.create'])]
    // private ?Enrobage $id_enrobage = null;

    #[ORM\ManyToOne(inversedBy: 'produits_enrobage')]
    #[ORM\JoinColumn(nullable: true, name: 'id_enrobage', referencedColumnName: 'id_enrobage')]
    private ?Enrobage $id_enrobage = null;

    #[ORM\PrePersist]
    public function setDateAjoutAutomatically(): void
    {
        $this->date_ajout = new \DateTime();
    }

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

    public function getAffinage(): ?string
    {
        return $this->affinage;
    }

    public function setAffinage(?string $affinage): static
    {
        $this->affinage = $affinage;

        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(?string $stock): static
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
