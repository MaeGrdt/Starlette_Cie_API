<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['produits.boutique']],
    denormalizationContext: ['groups' => ['produits.create']],
)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_image')]
    #[Groups(['produits.create', 'produits.boutique'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['produits.create', 'produits.boutique'])]
    private ?string $url = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups(['produits.create'])]
    private ?string $type_image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type_image;
    }

    public function setType(?string $type_image): static
    {
        $this->type_image = $type_image;

        return $this;
    }
}
