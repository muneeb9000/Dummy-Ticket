<?php

namespace App\Events;

use App\Models\CustomPayment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomPaymentCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

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
        $this->message = $message ?? "Travel Order From {$customPayment->first_name} - Custom Payment Form";
        $this->show = $show;
    }
}
