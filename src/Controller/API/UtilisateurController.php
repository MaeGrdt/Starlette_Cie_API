<?php

namespace App\Controller\API;


use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class UtilisateurController extends AbstractController
{
//     #[Route("/api/utilisateurs", methods: ["GET"])]
//   public function index(UtilisateurRepository $utilisateurRepository)
//   {
//     $users = $utilisateurRepository->findAll();
//     return $this->json($users, 200, [], [
//       'groups' => ['utilisateurs.index']
//     ]);
//   }
// #[Route("/api/utilisateurs", methods: ["POST"])]
// public function inscrire(
//     Request $request,
//     EntityManagerInterface $entityManager,
//     UserPasswordHasherInterface $passwordHasher,
//     ValidatorInterface $validator
// ): JsonResponse {
//     $data = json_decode($request->getContent(), true);

//     if (!isset($data['nom'], $data['prenom'], $data['email'], $data['mot_de_passe'])) {
//         return new JsonResponse(['message' => 'Données incomplètes'], Response::HTTP_BAD_REQUEST);
//     }

//     $utilisateur = new Utilisateur();
//     $utilisateur->setNom($data['nom']);
//     $utilisateur->setPrenom($data['prenom']);
//     $utilisateur->setEmail($data['email']);

//     $hashedPassword = $passwordHasher->hashPassword($utilisateur, $data['mot_de_passe']);
//     $utilisateur->setMotDePasse($hashedPassword);

//     $errors = $validator->validate($utilisateur);
//     if (count($errors) > 0) {
//         $errorMessages = [];
//         foreach ($errors as $error) {
//             $errorMessages[] = [
//                 'field' => $error->getPropertyPath(),
//                 'message' => $error->getMessage()
//             ];
//         }
//         return new JsonResponse(['errors' => $errorMessages], Response::HTTP_UNPROCESSABLE_ENTITY);
//     }

//     $entityManager->persist($utilisateur);
//     $entityManager->flush();

//     return $this->json($utilisateur, Response::HTTP_CREATED, [], [
//         'groups' => ['utilisateurs.register']
//     ]);
// }



//   #[Route("/api/utilisateurs/{id}", requirements: ['id' => Requirement::DIGITS], methods: ["GET"])]
//   public function show(Utilisateur $users)
//   {
//     return $this->json($users, 200, [], [
//       'groups' => ['utilisateurs.index']
//     ]);
//   }
}

