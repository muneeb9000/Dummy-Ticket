<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'no_of_travelers', 'no_of_hotels',
        'additional_details', 'price'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function hotelDetails()
    {
        return $this->hasMany(HotelDetail::class);
    }
}