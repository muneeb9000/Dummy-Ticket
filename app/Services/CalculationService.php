<?php

namespace App\Services;

class CalculationService
{
    public function calculateFlightReservation(array $data)
    {
        if($data['flightReservation'] !== 'yes' )
        return false;

        $basePrices = [1 => 20, 2 => 28, 3 => 42, 4 => 56, 5 => 70, 6 => 84, 7 => 98, 8 => 112];
        $extraFlightPrices = [3 => 0, 4 => 0, 5 => 10, 6 => 20, 7 => 30, 8 => 40, 9 => 50];

        $travellers = isset($data['total_flight_reservation_travelers']) ? intval($data['total_flight_reservation_travelers']) : 1;
        $extraFlights = isset($data['extra_flights']) ? intval($data['extra_flights']) : 0;

        $basePrice = $basePrices[$travellers] ?? 0;
        $extraPrice = $extraFlightPrices[$extraFlights] ?? 0;

        return $basePrice + $extraPrice;
    }

    public function calculateHotelBooking(array $data)
    {
        if($data['hotelBooking'] !== 'yes' )
         return false;

        $basePrices = [1 => 20, 2 => 28, 3 => 42, 4 => 56, 5 => 70, 6 => 84, 7 => 98, 8 => 112];
        $extraHotelPrices = [3 => 0, 4 => 0, 5 => 10, 6 => 20, 7 => 30, 8 => 40, 9 => 50];

        $travellers = isset($data['total_hotel_booking_travelers']) ? intval($data['total_hotel_booking_travelers']) : 1;
        $extraHotels = isset($data['extra_hotels']) ? intval($data['extra_hotels']) : 0;

        $basePrice = $basePrices[$travellers] ?? 0;
        $extraPrice = $extraHotelPrices[$extraHotels] ?? 0;

        return $basePrice + $extraPrice;
    }

    public function calculateFlightAndHotelBooking(array $data)
    {
        if ($data['hotelBooking'] !== 'yes' && $data['flightReservation'] !== 'yes')
        return false;
        $basePrices = [1 => 28, 2 => 39.2, 3 => 58.8, 4 => 78.4, 5 => 98, 6 => 117.6, 7 => 137.2, 8 => 156.8];
        $extraHotelPrices = [3 => 0, 4 => 0, 5 => 10, 6 => 20, 7 => 30, 8 => 40, 9 => 50];
        $extraFlightPrices = [3 => 0, 4 => 0, 5 => 10, 6 => 20, 7 => 30, 8 => 40, 9 => 50];

        $travellers = isset($data['total_flight_and_hotel_reservation_travellers']) ? intval($data['total_flight_and_hotel_reservation_travellers']) : 1;
        $extraHotels = isset($data['extra_hotels']) ? intval($data['extra_hotels']) : 0;
        $extraFlights = isset($data['extra_flights']) ? intval($data['extra_flights']) : 0;

        $basePrice = $basePrices[$travellers] ?? 0;
        $HotelPrice = $extraHotelPrices[$extraHotels] ?? 0;
        $FlightPrice= $extraFlightPrices[$extraFlights] ?? 0;
        return $basePrice + $HotelPrice + $FlightPrice;
    }

    public function calculateTravelInsurance(array $data)
    {

         if($data['travel_insurance'] !== 'yes')
        return false;
        $insuranceBasePrice = 30;
        $insuranceDays = isset($data['insurance_days']) ? intval($data['insurance_days']) : 6;
        $visaPurpose = isset($data['insurance_purpose']) ? intval($data['insurance_purpose']) : 1;

        $travelers = isset($data['insurance_travelers']) ? $data['insurance_travelers'] : [];

        $total = 0;
        foreach ($travelers as $traveler) {
            $ageGroup = isset($traveler['age_group']) ? intval($traveler['age_group']) : 1;
            $isUsCitizen = isset($traveler['is_us_citizen']) ? intval($traveler['is_us_citizen']) : 1;
            $travelerPrice = ($ageGroup * $insuranceDays) + ($isUsCitizen == 1 ? 0 : 30) + $insuranceBasePrice;
            $total += $travelerPrice;
        }

        if ($visaPurpose == 2 && $total > 0) {
            $total += 40;
        }

        return $total;
    }

    public function calculateTravelGuides(array $data)
    {
        if($data['travel_guide'] !== 'yes')
        return false;
        $cities = isset($data['cities']) ? $data['cities'] : [];
        $total = 0;
        foreach ($cities as $price) {
            $num = floatval($price);
            if ($num > 0) {
                $total += $num + 8;
            }
        }
        return $total;
    }

    public function calculateUrgentReservation(array $data)
    {
        $pricing = [1 => 30, 2 => 15];
        $urgentReservation = isset($data['urgent_reservation']) ? intval($data['urgent_reservation']) : 0;
        return $pricing[$urgentReservation] ?? 0;
    }

    public function calculateTotalOrder(array $data, $flag = false)
    {
        $total=0;
        if ($flag) {
            $total+=$this->calculateFlightAndHotelBooking($data);
        }
        else
        {
            $total+=$this->calculateFlightReservation($data);
            $total+= $this->calculateHotelBooking($data);
        }
            $total+=$this->calculateTravelInsurance($data) ;
            $total+=$this->calculateTravelGuides($data) ;
            $total+=$this->calculateUrgentReservation($data);
            return $total;
    }
}
