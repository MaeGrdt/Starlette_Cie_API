<?php

namespace App\Dto;

use App\Entity\Enrobage;
use App\Entity\ProduitsVariants as ProduitsVariantsEntity;
use Symfony\Component\Validator\Constraints as Assert;

class ProduitsVariants
{
  #[Assert\NotBlank]
  public float $prix;

  #[Assert\NotBlank]
  public float $poids;

  #[Assert\NotBlank]
  public string $affinage;

  #[Assert\NotBlank]
  public string $stock;

  #[Assert\NotBlank]
  public string $description;

  #[Assert\NotBlank]
  public string $composition;

  public ?EnrobageInput $enrobage = null; // Intégration de EnrobageInput

  /**
   * Convertit ProduitsVariants en une entité ProduitsVariantsEntity.
   */
  public function toEntity(): ProduitsVariantsEntity
  {
    $variantEntity = new ProduitsVariantsEntity();
    $variantEntity->setPrix($this->prix);
    $variantEntity->setPoids($this->poids);
    $variantEntity->setAffinage($this->affinage);
    $variantEntity->setStock($this->stock);
    $variantEntity->setDescription($this->description);
    $variantEntity->setComposition($this->composition);

    return $variantEntity;
  }
}


