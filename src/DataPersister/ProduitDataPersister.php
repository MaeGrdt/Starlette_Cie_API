<?php

namespace App\DataPersister;

use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;

class ProduitDataPersister implements ProcessorInterface
{
  private EntityManagerInterface $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
  {
    if ($data instanceof Produit) {
      // Persistez l'image
      if ($image = $data->getIdImage()) {
        $this->entityManager->persist($image);
      }

      // Persistez les variantes
      foreach ($data->getProduitsVariants() as $variant) {
        $variant->setIdProduit($data); // Assurez-vous que la relation est définie
        $this->entityManager->persist($variant);
      }

      // Persistez le produit principal
      $this->entityManager->persist($data);
      $this->entityManager->flush();
    }
  }
}
