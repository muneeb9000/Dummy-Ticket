<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'no_of_travelers', 'no_of_flights',
        'additional_details', 'price'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function flightDetails()
    {
        return $this->hasMany(FlightDetail::class);
    }
}