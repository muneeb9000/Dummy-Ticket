<?php

namespace App\Listeners;

use App\Events\PaymentRecieved;
use App\Mail\NewFormSubmissionNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;
class PaymentRecievedNotification
{

    public function handle(PaymentRecieved $event): void
    {
        try {
        $formData = $event->formData;
        $filteredData = $formData;
        $subject='Great! We Received Your Payment Just Now! (Order#'.$formData->order_no.')';

        // For sending to customer (reply to admin)
        Mail::to($filteredData['email'])
            ->send(new NewFormSubmissionNotification(
                $filteredData,
                 'dev4@visamtion.org',
                 true,
                 $subject));

        // For sending to admin (reply to customer)
        Mail::to(setting('admin_email'))
            ->send(new NewFormSubmissionNotification($filteredData,
             $filteredData['email'],
             true,
             $subject));

            } catch (Exception $mailEx) {
            // You can log this error or handle it gracefully
          Log::error('Email sending failed payment recieved notification', [
                    'error' => $mailEx->getMessage(),
                    'trace' => $mailEx->getTraceAsString(),
                ]);

        }
    }
}
