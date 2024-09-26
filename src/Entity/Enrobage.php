<?php

namespace App\Entity;

use App\Repository\EnrobageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnrobageRepository::class)]
class Enrobage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_enrobage')]
    private ?int $id_enrobage = null;

    #[ORM\Column(length: 100)]
    private ?string $nom_enrobage = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToOne(targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_image', referencedColumnName: 'id_image')]
    private ?Image $id_image = null;

    /**
     * @var Collection<int, ProduitsVariants>
     */
    #[ORM\OneToMany(targetEntity: ProduitsVariants::class, mappedBy: 'id_enrobage')]
    private Collection $produits_enrobage;

    public function __construct()
    {
        $this->produits_enrobage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id_enrobage;
    }

    public function getNomEnrobage(): ?string
    {
        return $this->nom_enrobage;
    }

    public function setNomEnrobage(string $nom_enrobage): static
    {
        $this->nom_enrobage = $nom_enrobage;

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
    public function getProduitsEnrobage(): Collection
    {
        return $this->produits_enrobage;
    }

    public function addProduitsEnrobage(ProduitsVariants $produitsEnrobage): static
    {
        if (!$this->produits_enrobage->contains($produitsEnrobage)) {
            $this->produits_enrobage->add($produitsEnrobage);
            $produitsEnrobage->setIdEnrobage($this);
        }

        return $this;
    }

    public function removeProduitsEnrobage(ProduitsVariants $produitsEnrobage): static
    {
        if ($this->produits_enrobage->removeElement($produitsEnrobage)) {
            // set the owning side to null (unless already changed)
            if ($produitsEnrobage->getIdEnrobage() === $this) {
                $produitsEnrobage->setIdEnrobage(null);
            }
        }

        return $this;
    }
}
