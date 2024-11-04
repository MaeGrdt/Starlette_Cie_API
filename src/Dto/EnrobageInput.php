<?php

namespace App\Dto;

use App\Entity\Enrobage;
use Symfony\Component\Validator\Constraints as Assert;

class EnrobageInput
{
  #[Assert\NotBlank]
  #[Assert\Length(max: 100)]
  public ?string $nom_enrobage = null;

  #[Assert\NotBlank]
  public ?string $description = null;

  /**
   * Convertir EnrobageInput en une entité Enrobage.
   */
  public function toEntity(): Enrobage
  {
    $enrobage = new Enrobage();
    $enrobage->setNomEnrobage($this->nom_enrobage);
    $enrobage->setDescription($this->description);
    return $enrobage;
  }
}
