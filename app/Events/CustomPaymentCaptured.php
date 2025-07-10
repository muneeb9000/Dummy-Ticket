<?php

namespace App\Events;

use App\Models\CustomPayment;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomPaymentCaptured
{
    use Dispatchable, SerializesModels;

    public $customPayment;
    public $customReplyTo;
    public $flag;
    public $message;
    public $show;

    public function __construct(
        CustomPayment $customPayment,
        ?string $customReplyTo = null,
        bool $flag = false,
        ?string $message = null,
        bool $show = true
    ) {
        $this->customPayment = $customPayment;
        $this->customReplyTo = $customReplyTo ?? $customPayment->email;
        $this->flag = $flag;
        $this->message = $message ?? "Thank You For Making The Payment!";
        $this->show = $show;
    }
}
