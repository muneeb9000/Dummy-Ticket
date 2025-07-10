<?php

namespace App\Services;

use App\Managers\PaymentManager;

class PaymentService
{
    protected $manager;

    public function __construct(PaymentManager $manager)
    {
        $this->manager = $manager;
    }

    public function pay(string $method, array $data)
    {
        $gateway = $this->manager->gateway($method);
        return $gateway->charge($data);
    }

}
