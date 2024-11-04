<?php

namespace App\Dto;

use App\Entity\Image;
use Symfony\Component\Validator\Constraints as Assert;

class ImageInput
{
  #[Assert\NotBlank]
  #[Assert\Url]
  public ?string $url = null;

  #[Assert\NotBlank]
  #[Assert\Choice(['jpeg', 'png', 'gif', 'svg'])]  // exemple de validation pour le type d'image
  public ?string $type_image = null;

  /**
   * Convertir ImageInput en une entité Image.
   */
  public function toEntity(): Image
  {
    $image = new Image();
    $image->setUrl($this->url);
    $image->setType($this->type_image);
    return $image;
  }
}
