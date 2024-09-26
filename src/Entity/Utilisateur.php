<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ApiResource]
class Utilisateur
{
    #[ORM\Id, ORM\Column(name: 'id_utilisateur'), ORM\GeneratedValue]
    private ?int $id_utilisateur = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank]
    public string $nom = '';

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank]
    public string $prenom = '';

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email = '';

    #[ORM\Column(type: 'string', length: 14, nullable: true)]
    public ?string $telephone = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    public string $mot_de_passe = '';

    /**
     * @var Collection<int, Favoris>
     */
    #[ORM\OneToMany(targetEntity: Favoris::class, mappedBy: 'id_utilisateur')]
    private Collection $favoris;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'id_utilisateur')]
    private Collection $avis;

    #[ORM\OneToOne(targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_image', referencedColumnName: 'id_image')]
    private ?Image $id_image = null;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->avis = new ArrayCollection();
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->id_utilisateur;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getMotDePasse(): string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): self
    {
        $this->mot_de_passe = $mot_de_passe;
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
            $favori->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): static
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getIdUtilisateur() === $this) {
                $favori->setIdUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getIdUtilisateur() === $this) {
                $avi->setIdUtilisateur(null);
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
}
