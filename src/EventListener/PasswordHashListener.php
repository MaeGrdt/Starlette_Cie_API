<?php

namespace App\EventListener;

use App\Entity\Utilisateur;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class PasswordHashListener
{
  private UserPasswordHasherInterface $passwordHasher;

  public function __construct(UserPasswordHasherInterface $passwordHasher)
  {
    $this->passwordHasher = $passwordHasher;
  }

  public function onKernelView(ViewEvent $event): void
  {
    $utilisateur = $event->getControllerResult();
    $method = $event->getRequest()->getMethod();

    if (!$utilisateur instanceof Utilisateur || !in_array($method, ['POST', 'PUT'], true)) {
      return;
    }

    if ($utilisateur->getPassword()) {
      $hashedPassword = $this->passwordHasher->hashPassword($utilisateur, $utilisateur->getPassword());
      $utilisateur->setPassword($hashedPassword);
    }
  }
}
