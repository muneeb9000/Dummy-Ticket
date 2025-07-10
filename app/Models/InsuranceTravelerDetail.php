<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceTravelerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'travel_insurance_id', 'first_name', 'last_name', 'is_us_citizen',
        'age', 'date_of_birth', 'gender', 'citizen_ship', 'passport_number',
        'country', 'address', 'state', 'city', 'postal_code', 'phone_no',
        'beneficiary_name', 'beneficiary_relationship'
    ];

    public function travelInsurance()
    {
        return $this->belongsTo(TravelInsurance::class);
    }
}