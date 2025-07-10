<?php

namespace App\Listeners;

use App\Events\FormSubmitted;
use App\Mail\NewFormSubmissionNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class SendFormSubmissionNotification
{
    public function handle(FormSubmitted $event): void
    {
        try {
            $formData = $event->formData;

            $subject = 'New Form Submission Notification';

            // Send to customer (reply-to admin)
            Mail::to($formData['email'])
                ->send(new NewFormSubmissionNotification(
                    $formData,
                    setting('admin_email'),
                    false,
                    $subject
                ));

            // Send to admin (reply-to customer)
            Mail::to(setting('admin_email'))
                ->send(new NewFormSubmissionNotification(
                    $formData,
                    $formData['email'],
                    false,
                    $subject
                ));

        } catch (Exception $mailEx) {
            // You can log this error or handle it gracefully
          Log::error('Email sending failed New Form Submission', [
                    'error' => $mailEx->getMessage(),
                    'trace' => $mailEx->getTraceAsString(),
                ]);

        }
    }
}
