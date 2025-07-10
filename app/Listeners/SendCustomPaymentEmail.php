<?php

namespace App\Listeners;

use App\Events\CustomPaymentCreated;
use App\Mail\CustomPaymentMail;
use Illuminate\Support\Facades\Mail;

class SendCustomPaymentEmail
{
    public function handle(CustomPaymentCreated $event)
    {

        $adminEmail = setting('admin_email');
        Mail::to($adminEmail)
            ->send(new CustomPaymentMail(
                formData: $event->customPayment,
                customReplyTo: $event->customReplyTo,
                flag: $event->flag,
                message: $event->message,
                show: $event->show
            ));
    }
}