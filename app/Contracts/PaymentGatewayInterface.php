<?php

namespace App\Contracts;

interface PaymentGatewayInterface
{
    public function charge(array $data);
}
