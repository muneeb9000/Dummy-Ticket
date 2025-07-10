<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelDetail extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_booking_id', 'hotel'];

    public function hotelBooking()
    {
        return $this->belongsTo(HotelBooking::class);
    }
}