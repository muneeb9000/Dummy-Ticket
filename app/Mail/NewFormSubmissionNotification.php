<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class NewFormSubmissionNotification extends Mailable
{
    use SerializesModels;

    public function __construct(
        public Booking $formData,
        public ?string $customReplyTo = null,
        public bool $flag,
        public string $message,
        public ?bool $show = true,
    ) {}


    public function envelope(): Envelope
    {
        $address = config('mail.from.address');
        $replyToAddress = $this->customReplyTo;

        return new Envelope(
            from: new Address($address, 'FIFV Travels'),
            subject: $this->message,
            replyTo: $replyToAddress
                ? [new Address($replyToAddress)]
                : [],
        );
    }




    public function content(): Content
    {
        $getView = [
            "FlightReservation" => "forms.flight-reservation-email-template",
            "HotelBooking" => "forms.hotel-booking-email-template",
            "TravelInsurance" => "forms.travel-insurance-email-template",
            "FlightAndHotelBooking" => "forms.flight-reservation-email-template",
            "TravelGuides" => "forms.travel-guide-email-template",
        ];

        return new Content(
            view: $getView[$this->formData->type],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
