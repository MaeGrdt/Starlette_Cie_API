<?php

namespace App\Controller\API;

// use App\Entity\Produit;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\HttpFoundation\JsonResponse;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;

use App\Repository\ProduitRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
  #[Route("/api/produits")]
  public function index(ProduitRepository $produitRepository)
  {
    $produits = $produitRepository->findAll();
    return $this->json($produits, 200, [], [
      'groups' => ['produits.index']
    ]);
  }
}
