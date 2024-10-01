<?php

namespace App\Controller\API;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Requirement\Requirement;

class ProduitController extends AbstractController
{
  #[Route("/api/produits", methods: ["GET"])]
  public function index(ProduitRepository $produitRepository)
  {
    $produits = $produitRepository->findAll();
    return $this->json($produits, 200, [], [
      'groups' => ['produits.index']
    ]);
  }

  #[Route("/api/produits/{id}", requirements: ['id' => Requirement::DIGITS], methods: ["GET"])]
  public function show(Produit $produit)
  {
    return $this->json($produit, 200, [], [
      'groups' => ['produits.detail']
    ]);
  }
}
