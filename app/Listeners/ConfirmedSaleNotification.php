<?php

namespace App\Listeners;

use App\Events\ConfirmedSale;
use App\Mail\NewFormSubmissionNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class ConfirmedSaleNotification
{

    public function handle(ConfirmedSale $event): void
    {
        try {
            $formData = $event->formData;
            $filteredData = $formData;
            $subject = 'Confirmed Sales - Successfully Received (Order#' . $formData->order_no . ')';

            // For sending to customer (reply to admin)
            Mail::to(setting('cc_address'))
                ->send(new NewFormSubmissionNotification(
                    $filteredData,
                    $filteredData['email'],
                    true,
                    $subject,
                    false,
                ));

            // For sending to admin (reply to customer)
            // Mail::to(setting('admin_email'))
            //     ->send(new NewFormSubmissionNotification(
            //         $filteredData,
            //         setting('cc_address'),
            //         true,
            //         $subject
            //     ));
        } catch (Exception $mailEx) {
            // You can log this error or handle it gracefully
          Log::error('Email sending failed confirmed sales', [
                    'error' => $mailEx->getMessage(),
                    'trace' => $mailEx->getTraceAsString(),
                ]);

        }
    }
}
