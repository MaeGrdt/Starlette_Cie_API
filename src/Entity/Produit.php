<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\CategorieEnum;
use App\Enum\TypeEnum;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ApiResource()]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_produit')]
    #[Groups(['produits.index'])]
    private ?int $id_produit = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?CategorieEnum $categorie = null;

    #[ORM\Column(length: 50)]
    private ?TypeEnum $type_produit = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_ajout = null;

    /**
     * @var Collection<int, Favoris>
     */
    #[ORM\OneToMany(targetEntity: Favoris::class, mappedBy: 'id_produit')]
    private Collection $favoris;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'id_produit')]
    private Collection $id_utilisateur;

    #[ORM\OneToOne(targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_image', referencedColumnName: 'id_image')]
    private ?Image $id_image = null;

    /**
     * @var Collection<int, ProduitsVariants>
     */
    #[ORM\OneToMany(targetEntity: ProduitsVariants::class, mappedBy: 'id_produit')]
    private Collection $produitsVariants;

    /**
     * @var Collection<int, CommandeDetail>
     */
    #[ORM\ManyToMany(targetEntity: CommandeDetail::class, mappedBy: 'produits')]
    private Collection $commandeDetails;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->id_utilisateur = new ArrayCollection();
        $this->produitsVariants = new ArrayCollection();
        $this->commandeDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id_produit;
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

    public function getCategorie(): ?CategorieEnum
    {
        return $this->categorie;
    }

    public function setCategorie(CategorieEnum $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getType(): ?TypeEnum
    {
        return $this->type_produit;
    }

    public function setType(TypeEnum $type_produit): static
    {
        $this->type_produit = $type_produit;

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

    /**
     * @return Collection<int, Favoris>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): static
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
            $favori->setIdProduit($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): static
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getIdProduit() === $this) {
                $favori->setIdProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getIdUtilisateur(): Collection
    {
        return $this->id_utilisateur;
    }

    public function addIdUtilisateur(Avis $idUtilisateur): static
    {
        if (!$this->id_utilisateur->contains($idUtilisateur)) {
            $this->id_utilisateur->add($idUtilisateur);
            $idUtilisateur->setIdProduit($this);
        }

        return $this;
    }

    public function removeIdUtilisateur(Avis $idUtilisateur): static
    {
        if ($this->id_utilisateur->removeElement($idUtilisateur)) {
            // set the owning side to null (unless already changed)
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

    public function setIdImage(?Image $id_image): static
    {
        $this->id_image = $id_image;

        return $this;
    }

    /**
     * @return Collection<int, ProduitsVariants>
     */
    public function getProduitsVariants(): Collection
    {
        return $this->produitsVariants;
    }

    public function addProduitsVariant(ProduitsVariants $produitsVariant): static
    {
        if (!$this->produitsVariants->contains($produitsVariant)) {
            $this->produitsVariants->add($produitsVariant);
            $produitsVariant->setIdProduit($this);
        }

        return $this;
    }

    public function removeProduitsVariant(ProduitsVariants $produitsVariant): static
    {
        if ($this->produitsVariants->removeElement($produitsVariant)) {
            // set the owning side to null (unless already changed)
            if ($produitsVariant->getIdProduit() === $this) {
                $produitsVariant->setIdProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeDetail>
     */
    public function getCommandeDetails(): Collection
    {
        return $this->commandeDetails;
    }

    public function addCommandeDetail(CommandeDetail $commandeDetail): static
    {
        if (!$this->commandeDetails->contains($commandeDetail)) {
            $this->commandeDetails->add($commandeDetail);
            $commandeDetail->addProduit($this);
        }

        return $this;
    }

    public function removeCommandeDetail(CommandeDetail $commandeDetail): static
    {
        if ($this->commandeDetails->removeElement($commandeDetail)) {
            $commandeDetail->removeProduit($this);
        }

        return $this;
    }
}
