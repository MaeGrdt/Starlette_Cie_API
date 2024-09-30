<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FactureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
#[ApiResource()]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_facture')]
    private ?int $id_facture = null;

    #[ORM\Column(length: 255)]
    private ?string $url_facture = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_facture = null;

    #[ORM\OneToOne(targetEntity: Commande::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'id_commande', referencedColumnName: 'id_commande')]
    private ?Commande $id_commande = null;

    public function getId(): ?int
    {
        return $this->id_facture;
    }

    public function getUrlFacture(): ?string
    {
        return $this->url_facture;
    }

    public function setUrlFacture(string $url_facture): static
    {
        $this->url_facture = $url_facture;

        return $this;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->date_facture;
    }

    public function setDateFacture(\DateTimeInterface $date_facture): static
    {
        $this->date_facture = $date_facture;

        return $this;
    }

    public function getIdCommande(): ?Commande
    {
        return $this->id_commande;
    }

    public function setIdCommande(?Commande $id_commande): static
    {
        $this->id_commande = $id_commande;

        return $this;
    }
}
