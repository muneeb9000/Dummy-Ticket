<?php

namespace App\Services;

class BookingService
{
    protected $data;
    protected $calculatedTotals = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function calculate()
    {
        $this->calculatedTotals['flight'] = $this->calculateFlightPrice();
        $this->calculatedTotals['hotel'] = $this->calculateHotelPrice();
        $this->calculatedTotals['insurance'] = $this->calculateInsurancePrice();
        $this->calculatedTotals['guide'] = $this->calculateTravelGuidePrice();
        $this->calculatedTotals['urgent'] = $this->calculateUrgentReservationFee();

        $this->calculatedTotals['total'] = array_sum($this->calculatedTotals);

        return $this->matchTotals();
    }

    protected function calculateFlightPrice(): float
    {
        if ($this->data['flightReservation'] !== 'yes') return 0;

        $travellers = (int) $this->data['total_flight_reservation_travellers'];
        $flights = is_array($this->data['flights']) ? count($this->data['flights']) : 0;
        $pricePerFlight = 10; // Example price

        return $travellers * $flights * $pricePerFlight;
    }

    protected function calculateHotelPrice(): float
    {
        if ($this->data['hotelBooking'] !== 'yes') return 0;

        $travelers = (int) $this->data['total_hotel_booking_travelers'];
        $hotels = is_array($this->data['hotels']) ? count($this->data['hotels']) : 0;
        $pricePerHotel = 10; // Example price

        return $travelers * $hotels * $pricePerHotel;
    }

    protected function calculateInsurancePrice(): float
    {
        if ($this->data['travel_insurance'] !== 'yes') return 0;

        $travelers = (int) $this->data['insurance_num_of_travelers'];
        $pricePerTraveler = 120; // Example price

        return $travelers * $pricePerTraveler;
    }

    protected function calculateTravelGuidePrice(): float
    {
        if ($this->data['travel_guide'] !== 'yes') return 0;

        $cities = (int) $this->data['num_of_cities'];
        $pricePerCity = 17.985; // Example price

        return $cities * $pricePerCity;
    }

    protected function calculateUrgentReservationFee(): float
    {
        return isset($this->data['urgent_reservation']) ? (float) $this->data['urgent_reservation'] : 0;
    }

    protected function matchTotals(): array
    {
        return [
            'calculated_totals' => $this->calculatedTotals,
            'provided_totals' => [
                'flight' => (float) $this->data['total_flight_reservation_price'],
                'hotel' => (float) $this->data['total_hotel_booking_price'],
                'insurance' => (float) $this->data['total_travel_insurance_price'],
                'guide' => (float) $this->data['total_travel_guides_price'],
                'total' => (float) $this->data['total_order'],
            ],
            'matched' => $this->compareTotals(),
        ];
    }

    protected function compareTotals(): bool
    {
        $calculated = number_format($this->calculatedTotals['total'], 2, '.', '');
        $provided = number_format($this->data['total_order'], 2, '.', '');

        return $calculated == $provided;
    }
}
