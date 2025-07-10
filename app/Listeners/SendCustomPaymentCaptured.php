<?php

namespace App\Listeners;

use App\Events\CustomPaymentCaptured;
use App\Mail\CustomPaymentMail;
use App\Mail\CustomPaymentCapturedMail;
use Illuminate\Support\Facades\Mail;

class SendCustomPaymentCaptured
{
    /**
     * Handle the event.
     */
    public function handle(CustomPaymentCaptured $event): void
    {
        Mail::to(setting('admin_email'))
            ->send(new CustomPaymentCapturedMail(
                formData: $event->customPayment,
                customReplyTo: $event->customPayment->email,
                flag: true,
                message: $event->message,
                show: true
        ));
    }
}
