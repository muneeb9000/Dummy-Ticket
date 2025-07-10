<?php

namespace App\Mail;

use App\Models\CustomPayment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class CustomPaymentAcknowledgmentMail extends Mailable
{
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public CustomPayment $formData,
        public ?string $customReplyTo = null,
        public bool $flag,
        public string $message,
        public ?bool $show = true,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $replyToAddress = $this->customReplyTo;
  $address = config('mail.from.address');
        return new Envelope(
            from: new Address($address, 'FIFV Travels'),
            subject: $this->message,
            replyTo: $replyToAddress ? [new Address($replyToAddress)] : [],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.custom-payment-acknowledgment-email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
