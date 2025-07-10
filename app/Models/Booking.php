<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'first_name', 'last_name', 'email', 'phone',
        'interview_documents', 'future_delivery_date', 'referral_source',
        'flight_reservation', 'hotel_booking', 'travel_insurance',
        'travel_guide', 'urgent_reservation', 'total_price','status','discount','type','order_no','no_of_travelers','ss_id',
        'payment_processed'
    ];

    public function flightReservations()
    {
        return $this->hasOne(FlightReservation::class);
    }

    public function hotelBookings()
    {
        return $this->hasOne(HotelBooking::class);
    }

    public function travelerDetails()
    {
        return $this->hasMany(TravelerDetail::class);
    }

    public function travelInsurances()
    {
        return $this->hasOne(TravelInsurance::class);
    }

    public function travelGuides()
    {
        return $this->hasOne(TravelGuide::class);
    }

      public function travelers()
    {
        return $this->hasMany(TravelerDetail::class);
    }
}
