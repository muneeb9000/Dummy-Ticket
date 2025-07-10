<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightDetail extends Model
{
    use HasFactory;

    protected $fillable = ['flight_reservation_id', 'flight'];

    public function flightReservation()
    {
        return $this->belongsTo(FlightReservation::class);
    }
}