<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Enrobage;
use App\Entity\Image;
use App\Entity\Produit;
use App\Entity\ProduitsVariants;
use App\Repository\EnrobageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends AbstractController
{
    #[Route('/api/produits', name: 'create_produit', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, EnrobageRepository $enrobageRepository): Response
    {
        $data = json_decode($request->getContent(), true);

        // Création du produit
        $produit = new Produit();
        $produit->setNom($data['nom']);
        $produit->setCategorie($data['categorie']);
        $produit->setTypeProduit($data['type_produit']);

        // Ajout de la description et composition au produit (champs déplacés de ProduitsVariants vers Produit)
        if (isset($data['description'])) {
            $produit->setDescription($data['description']);
        }

        if (isset($data['composition'])) {
            $produit->setComposition($data['composition']);
        }

        // Gestion de l'image pour le produit
        if (isset($data['image'])) {
            $imageData = $data['image'];
            $image = new Image();
            $image->setUrl($imageData['url']);
            $image->setType($imageData['type_image']);
            $produit->setIdImage($image);
        }

        // Gestion des variantes de produit
        if (isset($data['variants'])) {
            foreach ($data['variants'] as $variant) {
                $produitVariant = new ProduitsVariants();
                $produitVariant->setPrix($variant['prix']);
                $produitVariant->setPoids($variant['poids']);
                $produitVariant->setStock($variant['stock']);

                // Vérification de la présence de l'affinage
                if (isset($variant['affinage'])) {
                    $produitVariant->setAffinage($variant['affinage']);
                }

                // Vérification de la présence de l'enrobage
                if (isset($variant['enrobage']) && isset($variant['enrobage']['nom_enrobage'])) {
                    $nom_enrobage = $variant['enrobage']['nom_enrobage'];
                    $enrobage = $enrobageRepository->findOneBy(['nom_enrobage' => $nom_enrobage]);

                    if (!$enrobage) {
                        $enrobage = new Enrobage();
                        $enrobage->setNomEnrobage($nom_enrobage);

                        if (isset($variant['enrobage']['description'])) {
                            $enrobage->setDescription($variant['enrobage']['description']);
                        }

                        $entityManager->persist($enrobage);
                    }
                    $produitVariant->setIdEnrobage($enrobage);
                }

                $produit->addProduitsVariant($produitVariant);
            }
        }

        $entityManager->persist($produit);
        $entityManager->flush();

        return new Response('Produit créé avec succès', Response::HTTP_CREATED);
    }
}
