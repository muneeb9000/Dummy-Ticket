<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelGuide extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'no_of_cities', 'price'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function travelGuideDetails()
    {
        return $this->hasMany(TravelGuideDetail::class, 'travel_guides_id');
    }
}