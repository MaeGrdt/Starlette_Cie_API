<?php

namespace App\Controller\API;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Repository\ProduitRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Requirement\Requirement;

class ProduitController extends AbstractController
{
  // #[Route("/api/produits", methods: ["GET"])]
  // public function index(ProduitRepository $produitRepository)
  // {
  //   $produits = $produitRepository->findAll();
  //   return $this->json($produits, 200, [], [
  //     'groups' => ['produits.index']
  //   ]);
  // }

  // #[Route("/api/produits/{id}", requirements: ['id' => Requirement::DIGITS], methods: ["GET"])]
  // public function show(Produit $produit)
  // {
  //   return $this->json($produit, 200, [], [
  //     'groups' => ['produits.detail']
  //   ]);
  // }



  // #[Route("/api/test", name: "test", methods: ["GET"])]
  // public function test()
  // {
  //   dd("bonjour");
  // }

  #[Route("/api/produits", name: "api_product_create", methods: ["POST"])]
  public function create(EntityManagerInterface $entityManager, Request $request): JsonResponse
  {
    // Récupérer les données de la requête JSON
    $data = json_decode($request->getContent(), true);

    // Validation des données transmises
    if (empty($data['nom']) || empty($data['categorie']) || empty($data['type_produit'])) {
      return new JsonResponse(['error' => "Les champs 'nom', 'categorie', et 'type_produit' sont requis."], 400);
    }

    // Validation des types de données (ex: 'nom' et 'categorie' doivent être des chaînes, 'type_produit' un entier, etc.)
    if (!is_string($data['nom']) || !is_string($data['categorie']) || !is_string($data['type_produit'])) {
      return new JsonResponse(['error' => "Les types de données sont incorrects."], 400);
    }

    // Filtrage des données pour éviter tout caractère spécial potentiellement dangereux (XSS, etc.)
    $nom = htmlspecialchars(trim($data['nom']));
    $categorie = htmlspecialchars(trim($data['categorie']));
    $typeProduit = htmlspecialchars(trim($data['type_produit']));

    // Création du produit
    $produit = new Produit();
    $produit->setNom($nom)
      ->setCategorie($categorie)
      ->setTypeProduit($typeProduit);

    try {
      // Sauvegarde dans la BDD avec Doctrine, qui protège déjà contre les injections SQL
      $entityManager->persist($produit);
      $entityManager->flush();

      // Retourner une réponse succès
      return new JsonResponse(['success' => "Le produit a été ajouté avec succès."], 201);
    } catch (\Exception $e) {
      // Gestion des exceptions lors de la sauvegarde
      return new JsonResponse(['error' => "Une erreur est survenue lors de l'ajout du produit."], 500);
    }
  }



  // #[Route("/api/produits", name: "api_product_create", methods: ["POST"])]
  // public function create(EntityManagerInterface $entityManager, Request $request): JsonResponse
  // {
  //   dump("bonjour");
  //   // récupère les données
  //   $data = json_decode($request->getContent(),true);

  //   // validation des données transmises
  //   if(!isset($data['nom']) || !isset($data['categorie']) || !isset($data['type_produit']))
  //   {
  //     return new JsonResponse(['error'=>"les datas sont invalides."], 400);
  //   }

  //   // creation du produit
  //   $produit = new Produit();
  //   $produit->setNom($data['nom'])->setCategorie($data['categorie'])->setTypeProduit($data['type_produit']);
  //   dump($produit);

  //   // sauvegarde dans la BDD
  //   $entityManager->persist($produit);
  //   $entityManager->flush();

  //   // renvoyer une réponse serveur
  //   return new JsonResponse(['success'=>"le produit a été ajouté avec succès."], 201);
  // }
}
