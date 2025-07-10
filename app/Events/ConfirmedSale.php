<?php

namespace App\Events;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;
class ConfirmedSale
{
    use  SerializesModels;

    /**
     * Create a new event instance.
     */
  public function __construct(public Booking  $formData){}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

}
