<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use App\Controller\ProduitController;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext: ['groups' => ['produits.boutique', 'produits.details']],
    denormalizationContext: ['groups' => ['produits.create']],
    operations: [
        new GetCollection(normalizationContext: ['groups' => ['produits.boutique']]),
        new Get(),
        new Post(
            uriTemplate: '/produits',
            controller: ProduitController::class . '::create',
        ),
        new Patch(),
        new Delete()
    ]
)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_produit')]
    #[Groups(['produits.details', 'produits.create', 'produits.boutique'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    #[Groups(['produits.details', 'produits.create', 'produits.boutique'])]
    private ?string $nom = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    #[Groups(['produits.create', 'produits.details', 'produits.boutique'])]
    private ?string $categorie = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    #[Groups(['produits.create', 'produits.details', 'produits.boutique'])]
    private ?string $type_produit = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['produits.details'])]
    private ?\DateTimeInterface $date_ajout = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Groups(['produits.details', 'produits.create'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    #[Groups(['produits.details', 'produits.create'])]
    private ?string $composition = null;

    #[ORM\OneToMany(targetEntity: Favoris::class, mappedBy: 'id_produit')]
    private Collection $favoris;

    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'id_produit')]
    private Collection $id_utilisateur;

    #[ORM\OneToOne(targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_image', referencedColumnName: 'id_image')]
    #[Groups(['produits.details', 'produits.create', 'produits.boutique'])]
    private ?Image $id_image = null;

    #[ORM\OneToMany(targetEntity: ProduitsVariants::class, mappedBy: 'id_produit', cascade: ['persist'])]
    #[Groups(['produits.details', 'produits.create', 'produits.boutique'])]
    private Collection $produitsVariants;

    #[ORM\ManyToMany(targetEntity: CommandeDetail::class, mappedBy: 'produits')]
    private Collection $commandeDetails;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->id_utilisateur = new ArrayCollection();
        $this->produitsVariants = new ArrayCollection();
        $this->commandeDetails = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function setDateAjoutAutomatically(): void
    {
        $this->date_ajout = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }

    public function getTypeProduit(): ?string
    {
        return $this->type_produit;
    }

    public function setTypeProduit(?string $type_produit): self
    {
        $this->type_produit = $type_produit;
        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->date_ajout;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getComposition(): ?string
    {
        return $this->composition;
    }

    public function setComposition(string $composition): self
    {
        $this->composition = $composition;

        return $this;
    }

    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
            $favori->setIdProduit($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): self
    {
        if ($this->favoris->removeElement($favori)) {
            if ($favori->getIdProduit() === $this) {
                $favori->setIdProduit(null);
            }
        }

        return $this;
    }

    public function getIdUtilisateur(): Collection
    {
        return $this->id_utilisateur;
    }

    public function addIdUtilisateur(Avis $idUtilisateur): self
    {
        if (!$this->id_utilisateur->contains($idUtilisateur)) {
            $this->id_utilisateur->add($idUtilisateur);
            $idUtilisateur->setIdProduit($this);
        }

        return $this;
    }

    public function removeIdUtilisateur(Avis $idUtilisateur): self
    {
        if ($this->id_utilisateur->removeElement($idUtilisateur)) {
            if ($idUtilisateur->getIdProduit() === $this) {
                $idUtilisateur->setIdProduit(null);
            }
        }

        return $this;
    }

    public function getIdImage(): ?Image
    {
        return $this->id_image;
    }

    public function setIdImage(?Image $id_image): self
    {
        $this->id_image = $id_image;
        return $this;
    }

    public function getProduitsVariants(): Collection
    {
        return $this->produitsVariants;
    }

    public function addProduitsVariant(ProduitsVariants $produitsVariant): self
    {
        if (!$this->produitsVariants->contains($produitsVariant)) {
            $this->produitsVariants->add($produitsVariant);
            $produitsVariant->setIdProduit($this);
        }
        return $this;
    }

    public function removeProduitsVariant(ProduitsVariants $produitsVariant): self
    {
        if ($this->produitsVariants->removeElement($produitsVariant)) {
            if ($produitsVariant->getIdProduit() === $this) {
                $produitsVariant->setIdProduit(null);
            }
        }

        return $this;
    }

    public function getCommandeDetails(): Collection
    {
        return $this->commandeDetails;
    }

    public function addCommandeDetail(CommandeDetail $commandeDetail): self
    {
        if (!$this->commandeDetails->contains($commandeDetail)) {
            $this->commandeDetails->add($commandeDetail);
            $commandeDetail->addProduit($this);
        }

        return $this;
    }

    public function removeCommandeDetail(CommandeDetail $commandeDetail): self
    {
        if ($this->commandeDetails->removeElement($commandeDetail)) {
            $commandeDetail->removeProduit($this);
        }

        return $this;
    }
}
