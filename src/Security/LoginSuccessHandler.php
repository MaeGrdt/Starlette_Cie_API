<?php

namespace App\Security;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
  private $jwtManager;

  public function __construct(JWTTokenManagerInterface $jwtManager)
  {
    $this->jwtManager = $jwtManager;
  }

  public function onAuthenticationSuccess(Request $request, TokenInterface $token): JsonResponse
  {
    // Récupérer l'utilisateur
    $user = $token->getUser();

    // Générer le token JWT
    $jwt = $this->jwtManager->create($user);

    // Construire la réponse
    return new JsonResponse([
      'token' => $jwt,
      'roles' => $user->getRoles(), // Récupérer les rôles de l'utilisateur
    ], Response::HTTP_OK);
  }
}
