<?php

namespace App\Entity;

use App\Enum\TypeImageEnum;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_image')]
    private ?int $id_image = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 50)]
    private ?TypeImageEnum $type_image = null;

    public function getId(): ?int
    {
        return $this->id_image;
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

    public function getType(): ?TypeImageEnum
    {
        return $this->type_image;
    }

    public function setType(TypeImageEnum $type_image): static
    {
        $this->type_image = $type_image;

        return $this;
    }
}
