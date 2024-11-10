<?php

namespace App\Controller;

use App\Service\StripeService;
use Stripe\Webhook;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class PaymentController
{
  private StripeService $stripeService;

  public function __construct(StripeService $stripeService)
  {
    $this->stripeService = $stripeService;
  }

  /**
   * Route pour créer la session Stripe Checkout
   */
  #[Route('/api/create-checkout-session', name: 'create_checkout_session', methods: ['POST'])]
  public function createCheckoutSession(Request $request): JsonResponse
  {
    $data = json_decode($request->getContent(), true);
    $panier = $data['panier']; // Données du panier (produits, quantité, prix)

    // Calculer le montant total de la commande en centimes
    $amount = array_reduce($panier, function ($acc, $item) {
      return $acc + $item['prix'] * $item['quantity'];
    }, 0) * 100; // Montant en centimes

    try {
      // Créer la session Stripe Checkout
      $checkoutSession = $this->stripeService->createCheckoutSession($amount);

      return new JsonResponse(['sessionId' => $checkoutSession->id]);
    } catch (\Exception $e) {
      return new JsonResponse(['error' => $e->getMessage()], 500);
    }
  }

  /**
   * Route pour recevoir les notifications de Stripe (webhook)
   */
  #[Route('/api/webhook-stripe', name: 'stripe_webhook', methods: ['POST'])]
  public function handleStripeWebhook(Request $request): Response
  {
    $payload = $request->getContent();
    $sigHeader = $request->headers->get('Stripe-Signature');
    $endpointSecret = 'votre_stripe_webhook_secret'; // Remplacez par votre secret de webhook Stripe

    try {
      // Vérifiez l'événement Stripe à l'aide du secret de signature
      $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);

      // Vérifiez si l'événement est de type checkout.session.completed
      if ($event->type === 'checkout.session.completed') {
        $session = $event->data->object; // Récupérez la session de paiement

        // Exemple : récupération de l'ID de la session de paiement
        $sessionId = $session->id;

        return new Response('Webhook received and processed', 200);
      }

      dd($event->type);

      // Vous pouvez également gérer d'autres types d'événements ici si nécessaire
      return new Response('Unhandled event type', 200);
    } catch (\Exception $e) {
      // Retourner une erreur si quelque chose échoue
      return new Response('Webhook Error: ' . $e->getMessage(), 400);
    }
  }

  #[Route('/api/check-payment-status', name: 'check_payment_status', methods: ['GET'])]
  public function checkPaymentStatus(Request $request): JsonResponse
  {
    $sessionId = $request->query->get('session_id');

    try {
      $paymentStatus = $this->stripeService->checkPaymentStatus($sessionId);
      return new JsonResponse(['status' => $paymentStatus ? 'success' : 'failed']);
    } catch (\Exception $e) {
      return new JsonResponse(['error' => $e->getMessage()], 500);
    }
  }
}
