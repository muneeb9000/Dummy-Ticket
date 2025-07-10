<?php

namespace App\Events;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class FormSubmitted
{
    use  SerializesModels;
    /**
     * Create a new event instance.
     */
    public function __construct(public Booking  $formData){}

}
