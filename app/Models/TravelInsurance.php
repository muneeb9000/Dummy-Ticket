<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelInsurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'title', 'first_name', 'last_name',
        'no_of_travelers', 'start_date', 'end_date',
        'travelling_from', 'travelling_to', 'insurance_purpose', 'price'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function insuranceTravelerDetails()
    {
        return $this->hasMany(InsuranceTravelerDetail::class);
    }
}