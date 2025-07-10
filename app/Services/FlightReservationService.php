<?php

namespace App\Services;

class FlightReservationService
{
    /**
     * Basic price configurations
     */
    protected $travellerPrices = [
        1 => 20,
        2 => 28,
        3 => 42,
        4 => 56,
        5 => 70,
        6 => 84,
        7 => 98,
        8 => 112,
    ];

    protected $extraFlightPrices = [
        3 => 0,
        4 => 0,
        5 => 10,
        6 => 20,
        7 => 30,
        8 => 40,
        9 => 50,
    ];

    protected $extraHotelPrices = [
        3 => 0,
        4 => 0,
        5 => 10,
        6 => 20,
        7 => 30,
        8 => 40,
        9 => 50,
    ];

    protected $urgentReservationPrices = [
        'yes' => 30,
        'no' => 0,
    ];

    protected $insuranceBasePrice = 30;
    protected $insurancePurposeUseable = 40; // Extra cost for actual journey usable insurance

    /**
     * Calculate flight reservation price
     * 
     * @param bool $isFlightReservation
     * @param int $totalTravellers
     * @param int $extraFlights
     * @return float
     */
    public function calculateFlightReservationPrice($isFlightReservation, $totalTravellers, $extraFlights)
    {
        if (!$isFlightReservation) {
            return 0;
        }

        $travellerPrice = $this->travellerPrices[$totalTravellers] ?? 0;
        $extraFlightPrice = $this->extraFlightPrices[$extraFlights] ?? 0;
        return $travellerPrice + $extraFlightPrice;
    }

    /**
     * Calculate hotel booking price
     * 
     * @param bool $isHotelBooking
     * @param int $totalHotelTravellers
     * @param int $extraHotels
     * @return float
     */
    public function calculateHotelBookingPrice($isHotelBooking, $totalHotelTravellers, $extraHotels)
    {
        if (!$isHotelBooking) {
            return 0;
        }
        
        $travellerPrice = $this->travellerPrices[$totalHotelTravellers] ?? 0;
        $extraHotelPrice = $this->extraHotelPrices[$extraHotels] ?? 0;
        return $travellerPrice + $extraHotelPrice;
    }

    /**
     * Calculate insurance price for an individual traveler
     * 
     * @param int $ageGroup
     * @param int $isUsCitizen
     * @param int $insuranceDays
     * @return float
     */
    public function calculateIndividualInsurancePrice($ageGroup, $isUsCitizen, $insuranceDays)
    {
        // Age group multiplier * days + US citizen premium (if applicable)
        $usCitizenPremium = ($isUsCitizen == 1) ? 0 : 30;
        return ($ageGroup * $insuranceDays) + $usCitizenPremium;
    }

    /**
     * Calculate total insurance price
     * 
     * @param bool $isTravelInsurance
     * @param array $insuranceTravellerInfo Array of traveller info with ageGroup and isUsCitizen
     * @param int $insuranceDays
     * @param int $visaPurpose 1 for visa only, 2 for visa+actual journey
     * @param int $insuranceNumOfTravellers
     * @return float
     */
    public function calculateTotalInsurancePrice($isTravelInsurance, $insuranceTravellerInfo, $insuranceDays, $visaPurpose, $insuranceNumOfTravellers)
    {
        if (!$isTravelInsurance) {
            return 0;
        }

        $travelersTotal = 0;
        foreach ($insuranceTravellerInfo as $traveler) {
            if (isset($traveler['ageGroup']) && $traveler['ageGroup']) {
                $travelersTotal += $this->calculateIndividualInsurancePrice(
                    $traveler['ageGroup'],
                    $traveler['isUsCitizen'],
                    $insuranceDays
                );
            }
        }

        $visaExtra = ($visaPurpose == 2) ? $this->insurancePurposeUseable : 0;
        return $travelersTotal + ($this->insuranceBasePrice * $insuranceNumOfTravellers) + $visaExtra;
    }

    /**
     * Calculate travel guide price
     * 
     * @param bool $isTravelGuide
     * @param array $citiesPrices Array of city prices
     * @return float
     */
    public function calculateTravelGuidePrice($isTravelGuide, $citiesPrices)
    {
        if (!$isTravelGuide) {
            return 0;
        }

        $totalPrice = 0;
        foreach ($citiesPrices as $price) {
            $price = (int) $price;
            if ($price > 0) {
                $totalPrice += $price + 8; // Base price + $8 per city
            }
        }

        return $totalPrice;
    }

    /**
     * Calculate urgent reservation price
     * 
     * @param string $urgentReservation 'yes' or 'no'
     * @return float
     */
    public function calculateUrgentReservationPrice($urgentReservation)
    {
        return $this->urgentReservationPrices[$urgentReservation] ?? 0;
    }

    /**
     * Calculate total order price
     * 
     * @param array $calculations All the calculated prices
     * @return float
     */
    public function calculateTotalOrderPrice($calculations)
    {
        return array_sum($calculations);
    }

    /**
     * Calculate all prices and return them in an array
     * 
     * @param array $data Form data
     * @return array
     */
    public function calculateAllPrices($data)
    {   
        $isFlightReservation = $data['flightReservation'] === 'yes';
        $isHotelBooking = isset($data['hotel_booking_checkbox'][0]) && $data['hotel_booking_checkbox'][0] === 'true';
        $isTravelInsurance = isset($data['travel_insurance_checkbox'][0]) && $data['travel_insurance_checkbox'][0] === 'yes';
        $isTravelGuide = isset($data['travel_guides_checkbox'][0]) && $data['travel_guides_checkbox'][0] === 'yes';
        $totalTravellers = (int) ($data['flight_no_of_travelers'] ?? 1);
        $extraFlights = (int) ($data['flight_traveler_add_extra_flight'][0] ?? 0);
        $totalHotelTravellers = (int) ($data['hotel_booking_no_of_travelers'][0] ?? 1);
        $extraHotels = (int) ($data['hotel_booking_add_extra_hotel'][0] ?? 0);
        $insuranceNumOfTravellers = (int) ($data['travel_insurance_no_of_travelers'][0] ?? 1);
        $insuranceDays = $this->calculateDays(
            $data['travel_insurance_start_date'][0] ?? null,
            $data['travel_insurance_end_date'][0] ?? null
        );
        $visaPurpose = (int) ($data['travel_insurance_purpose'][0] ?? 1);
        $insuranceTravellerInfo = [];
        for ($i = 0; $i < $insuranceNumOfTravellers; $i++) {
            if (isset($data['travel_insurance_info_traveler_age'][$i]) && isset($data['travel_insurance_info_citizen'][$i])) {
                $insuranceTravellerInfo[] = [
                    'ageGroup' => (int) $data['travel_insurance_info_traveler_age'][$i],
                    'isUsCitizen' => (int) $data['travel_insurance_info_citizen'][$i]
                ];
            }
        }
        $citiesPrices = [];
        if (isset($data['travel_guides_city']) && is_array($data['travel_guides_city'])) {
            $citiesPrices = $data['travel_guides_city'];
        }
        
        $urgentReservation = $data['urgent_order_selection'][0] ?? 'no';
        
        $flightReservationPrice = $this->calculateFlightReservationPrice(
            $isFlightReservation,
            $totalTravellers,
            $extraFlights
        );
        
        $hotelBookingPrice = $this->calculateHotelBookingPrice(
            $isHotelBooking,
            $totalHotelTravellers,
            $extraHotels
        );
        
        $travelInsurancePrice = $this->calculateTotalInsurancePrice(
            $isTravelInsurance,
            $insuranceTravellerInfo,
            $insuranceDays,
            $visaPurpose,
            $insuranceNumOfTravellers
        );
        
        $travelGuidePrice = $this->calculateTravelGuidePrice(
            $isTravelGuide,
            $citiesPrices
        );
        
        $urgentPrice = $this->calculateUrgentReservationPrice($urgentReservation);
    
        // Combine all prices
        $calculations = [
            'flight_reservation' => $flightReservationPrice,
            'hotel_booking' => $hotelBookingPrice,
            'travel_insurance' => $travelInsurancePrice,
            'travel_guides' => $travelGuidePrice,
            'urgent_reservation' => $urgentPrice
        ];
    
        $calculations['total'] = $this->calculateTotalOrderPrice($calculations);
    
        return $calculations;
    }
    
    /**
     * Calculate days between two dates
     * 
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    protected function calculateDays($startDate, $endDate)
    {
        if (!$startDate || !$endDate) {
            return 0;
        }

        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        $diff = $end->diff($start);
        
        return $diff->days;
    }
}