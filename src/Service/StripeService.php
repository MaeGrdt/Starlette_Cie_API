<?php

namespace App\Service;

use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeService
{
  private $stripeSecretKey;

  // Injection de la clé Stripe dans le constructeur
  public function __construct(string $stripeSecretKey)
  {
    $this->stripeSecretKey = $stripeSecretKey;
    Stripe::setApiKey($this->stripeSecretKey); // Utilise la clé Stripe
  }

  public function createCheckoutSession(int $amount)
  {
    $session = Session::create([
      'payment_method_types' => ['card'],
      'line_items' => [
        [
          'price_data' => [
            'currency' => 'eur',
            'product_data' => [
              'name' => 'Votre produit',
            ],
            'unit_amount' => $amount,
          ],
          'quantity' => 1,
        ],
      ],
      'mode' => 'payment',
      'success_url' => 'http://localhost:5173/profile?session_id={CHECKOUT_SESSION_ID}',
      'cancel_url' => 'http://localhost:5173/panier',
    ]);

    return $session;
  }

  public function checkPaymentStatus(string $sessionId): bool
  {
    $session = Session::retrieve($sessionId);
    return $session->payment_status === 'paid';
  }
}
