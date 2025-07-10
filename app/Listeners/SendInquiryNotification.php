<?php

namespace App\Listeners;

use App\Events\InquirySubmitted;
use App\Mail\InquiryNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class SendInquiryNotification
{

    public function handle(InquirySubmitted $event): void
    {
        try{
        Mail::to($event->data['email'])
            ->send(new InquiryNotification($event->data['name']));
        }
        catch (Exception $mailEx) {

          Log::error('Inquiry Email sending failed', [
                    'error' => $mailEx->getMessage(),
                    'trace' => $mailEx->getTraceAsString(),
                ]);

        }
    }
}
