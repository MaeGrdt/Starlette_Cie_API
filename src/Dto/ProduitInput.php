<?php

namespace App\Dto;

use App\Entity\Produit;
use App\Entity\ProduitsVariants;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class ProduitInput
{
  #[Groups(['produit.create'])]
  #[Assert\NotBlank]
  public string $nom;

  #[Groups(['produit.create'])]
  #[Assert\NotBlank]
  public string $categorie;

  #[Groups(['produit.create'])]
  #[Assert\NotBlank]
  public string $type_produit;

  #[Groups(['produit.create'])]
  #[Assert\NotBlank]
  public array $variants = [];

  #[Groups(['produit.create'])]
  public ?ImageInput $image = null;

  /**
   * Convertit le DTO ProduitInput en une entité Produit.
   */
  public function toEntity(): Produit
  {
    $produit = new Produit();
    $produit->setNom($this->nom);
    $produit->setCategorie($this->categorie);
    $produit->setTypeProduit($this->type_produit);

    if ($this->image) {
      $produit->setIdImage($this->image->toEntity());
    }

    foreach ($this->variants as $variantData) {
      $variant = new ProduitsVariants();
      $variant->setIdProduit($produit);
      $variant->setPrix($variantData['prix']);
      $variant->setPoids($variantData['poids']);
      $variant->setAffinage($variantData['affinage']);
      $variant->setStock($variantData['stock']);
      $variant->setDescription($variantData['description']);
      $variant->setComposition($variantData['composition']);

      $produit->addProduitsVariant($variant);
    }

    return $produit;
  }
}
