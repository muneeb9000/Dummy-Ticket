<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\CustomPayment;

class CustomPaymentAcknowledge
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
        $this->customReplyTo = setting('cc_address');
        $this->flag = $flag;
        $this->message = $message ?? "Payment Acknowledgement of Order# {$customPayment->order_number}";
        $this->show = $show;
    }
}
