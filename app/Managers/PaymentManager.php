<?php

namespace App\Managers;

use App\Contracts\PaymentGatewayInterface;
use App\Repositories\Payments\StripeGateway;
use App\Repositories\Payments\PaypalGateway;

class PaymentManager
{
    public function gateway(string $method): PaymentGatewayInterface
    {
        return match ($method) {
            'stripe' => new StripeGateway(),
            'paypal' => new PaypalGateway(),
            default => throw new \Exception("Unsupported payment method: $method"),
        };
    }
}
