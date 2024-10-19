<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PointDeVenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PointDeVenteRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['pointDeVente.index']],
    denormalizationContext: ['groups' => ['pointDeVente.create']],
)]
class PointDeVente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_point_de_vente')]
    #[Groups(['pointDeVente.index'], ['pointDeVente.create'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['pointDeVente.index'], ['pointDeVente.create'])]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['pointDeVente.index'], ['pointDeVente.create'])]
    private ?string $descriptif = null;

    #[ORM\Column(length: 255)]
    #[Groups(['pointDeVente.index'], ['pointDeVente.create'])]
    private ?string $adresse = null;

    #[ORM\Column(length: 50)]
    #[Groups(['pointDeVente.index'], ['pointDeVente.create'])]
    private ?string $jour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Groups(['pointDeVente.index'], ['pointDeVente.create'])]
    private ?\DateTimeInterface $horaire_debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Groups(['pointDeVente.index'], ['pointDeVente.create'])]
    private ?\DateTimeInterface $horaire_fin = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['pointDeVente.index'], ['pointDeVente.create'])]
    private ?string $cadence = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['pointDeVente.index'])]
    private ?string $iframe_google_map = null;

    /**
     * @var Collection<int, Commande>
     */
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'id_point_de_vente')]
    private Collection $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
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

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): static
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): static
    {
        $this->jour = $jour;

        return $this;
    }

    public function getHoraireDebut(): ?\DateTimeInterface
    {
        return $this->horaire_debut;
    }

    public function setHoraireDebut(\DateTimeInterface $horaire_debut): static
    {
        $this->horaire_debut = $horaire_debut;

        return $this;
    }

    public function getHoraireFin(): ?\DateTimeInterface
    {
        return $this->horaire_fin;
    }

    public function setHoraireFin(\DateTimeInterface $horaire_fin): static
    {
        $this->horaire_fin = $horaire_fin;

        return $this;
    }

    public function getCadence(): ?string
    {
        return $this->cadence;
    }

    public function setCadence(?string $cadence): static
    {
        $this->cadence = $cadence;

        return $this;
    }

    public function getIframeGoogleMap(): ?string
    {
        return $this->iframe_google_map;
    }

    public function setIframeGoogleMap(string $iframe_google_map): static
    {
        $this->iframe_google_map = $iframe_google_map;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setIdPointDeVente($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            if ($commande->getIdPointDeVente() === $this) {
                $commande->setIdPointDeVente(null);
            }
        }

        return $this;
    }
}
