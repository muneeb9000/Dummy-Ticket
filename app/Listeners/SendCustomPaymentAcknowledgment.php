<?php

namespace App\Listeners;

use App\Events\CustomPaymentAcknowledge;
use App\Mail\CustomPaymentAcknowledgmentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;


class SendCustomPaymentAcknowledgment
{
      public function handle(CustomPaymentAcknowledge $event): void
    {
        $payment = $event->customPayment;
        $customerEmail = $payment->email;
        $adminEmail = setting('admin_email');
        $ccEmail = setting('cc_address');

        // 1. Mail to Customer — Reply to cc
        Mail::to($customerEmail)->send(
            new CustomPaymentAcknowledgmentMail(
                formData: $payment,
                customReplyTo: $ccEmail,
                flag: true,
                message: $event->message,
                show: true
            )
        );

        // 2. Mail to Admin — Reply to customer
        Mail::to($adminEmail)->send(
            new CustomPaymentAcknowledgmentMail(
                formData: $payment,
                customReplyTo: $customerEmail,
                flag: true,
                message: $event->message,
                show: true
            )
        );
 // 3. Mail to CC — Reply to customer
        Mail::to($ccEmail)->send(
            new CustomPaymentAcknowledgmentMail(
                formData: $payment,
                customReplyTo: $customerEmail,
                flag: true,
                message: $event->message,
                show: true
            )
        );
    }
}
