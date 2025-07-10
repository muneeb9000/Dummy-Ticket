<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingStorageService
{
    public function store(array $data): Booking
    {

        return DB::transaction(function () use ($data) {

            $booking = Booking::create($this->extractBookingData($data));

            if ($booking->no_of_travelers) {
                $this->createTravelers($booking, $data);
            }
            if ($booking->flight_reservation) {
                $this->createFlightReservation($booking, $data);
            }

            // Handle hotel bookings
            if ($booking->hotel_booking) {
                $this->createHotelBooking($booking, $data);
            }

            // Handle travel insurance
            if ($booking->travel_insurance) {
                $this->createTravelInsurance($booking, $data);
            }

            // Handle travel guides
            if ($booking->travel_guide) {
                $this->createTravelGuide($booking, $data);
            }

            return $booking->load('flightReservations', 'hotelBookings', 'travelInsurances', 'travelGuides');
        });
    }

    private function createTravelers($booking, $data)
    {
        if (!empty($data['travellers']) && is_array($data['travellers'])) {
            foreach ($data['travellers'] as $traveller) {
                $booking->travelers()->create([
                    'title'      => $traveller['title'] ?? null,
                    'first_name' => $traveller['first_name'] ?? null,
                    'last_name'  => $traveller['last_name'] ?? null,
                ]);
            }
        }
    }

    private function extractBookingData(array $data): array
    {

        if($data['form-type'] == 'HotelBooking')
        $travellers = $data['total_hotel_booking_travelers'];
        else if($data['form-type'] == 'FlightReservation')
        $travellers = $data['total_flight_reservation_travelers'];
        else if ($data['form-type'] == 'FlightAndHotelBooking')
        $travellers = $data['total_flight_and_hotel_reservation_travellers'];
        else if ($data['form-type'] == 'TravelInsurance')
        $travellers = $data['insurance_num_of_travelers'];
        else if ($data['form-type'] == 'TravelGuides')
        $travellers = $data['num_of_cities'];


        return [
            'title' => $data['title'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'no_of_travelers' => $travellers,
            'interview_documents' => $data['interview_documents'] ?? null,
            'future_delivery_date' => $data['future_delivery_date'] ?? null,
            'referral_source' => $data['referral_source'] ?? null,
            'flight_reservation' => filter_var($data['flightReservation'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'hotel_booking' => filter_var($data['hotelBooking'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'travel_insurance' => filter_var($data['travel_insurance'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'travel_guide' => filter_var($data['travel_guide'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'urgent_reservation' => $data['urgent_reservation'] ?? null,
            'total_price' => $data['total_order'] ?? null,
            'status' => 'Pending',
            'discount' => $data['discount'] ?? null,
            'type' => $data['form-type'],
        ];
    }

    private function createFlightReservation(Booking $booking, array $data): void
    {

        $flightReservation = $booking->flightReservations()->create([
            'no_of_travelers'      => $data['total_flight_reservation_travelers'] ?? null,
            'no_of_flights' =>    $data['extra_flights'] ?? 2,
            'additional_details'   => $data['flight_additional_details'] ?? null,
            'price'                => $data['total_flight_reservation_price'] ?? 0,
        ]);


        $extraFlights = isset($data['extra_flights']) ? (int)$data['extra_flights'] : 2;

        for ($i = 0; $i < $extraFlights; $i++) {
            $flight = $data['flights'][$i] ?? 'User Left The Field Empty';
            $flightReservation->flightDetails()->create([
                'flight' => $flight,
            ]);
        }

    }


    private function createHotelBooking(Booking $booking, array $data): void
    {

        $extraHotels = isset($data['extra_hotels']) ? (int)$data['extra_hotels'] : 2;

        $hotelBooking = $booking->hotelBookings()->create([
            'no_of_travelers'     => $data['total_hotel_booking_travelers'] ?? null,
            'no_of_hotels'        => $data['extra_hotels'] ?? 2,
            'additional_details'  => $data['hotel_additional_details'] ?? null,
            'price'               => $data['total_hotel_booking_price'] ?? 0,
        ]);


        for ($i = 0; $i < $extraHotels; $i++) {
            $hotel = $data['hotels'][$i] ?? 'User Left The Field Empty';
            $hotelBooking->hotelDetails()->create([
                'hotel' => $hotel,
            ]);
        }
    }

    private function createTravelInsurance(Booking $booking, array $data): void
    {
        $travelInsurance = $booking->travelInsurances()->create([
            'title' => $data['insurance_title'] ?? null,
            'first_name' => $data['insurance_first_name'] ?? null,
            'last_name' => $data['insurance_last_name'] ?? null,
            'no_of_travelers' => $data['insurance_num_of_travelers'] ?? null,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'travelling_from' => $data['insurance_travelling_from'] ?? null,
            'travelling_to' => $data['insurance_travelling_to'] ?? null,
            'insurance_purpose' => $data['insurance_purpose'] ?? null,
            'price' => $data['total_travel_insurance_price'] ?? 0,
        ]);

        foreach ($data['insurance_travelers'] ?? [] as $traveler) {

            $is_us_citizen=$traveler['is_us_citizen'] == 2 ? true : false;
            $travelInsurance->insuranceTravelerDetails()->create([
                'first_name' => $traveler['first_name'] ?? null,
                'last_name' => $traveler['last_name'] ?? null,
                'is_us_citizen' => filter_var($is_us_citizen ?? false, FILTER_VALIDATE_BOOLEAN),
                'age' => $traveler['age_group'] ?? null,
                'date_of_birth' => $traveler['dob'] ?? null,
                'gender' => $traveler['gender'] ?? null,
                'citizen_ship' => $traveler['citizenship'] ?? null,
                'passport_number' => $traveler['passport'] ?? null,
                'country' => $traveler['home_country'] ?? null,
                'address' => $traveler['home_country_address'] ?? null,
                'state' => $traveler['home_country_state'] ?? null,
                'city' => $traveler['home_country_city'] ?? null,
                'postal_code' => $traveler['home_country_postal_code'] ?? null,
                'phone_no' => $traveler['home_country_phone'] ?? null,
                'beneficiary_name' => $traveler['beneficiary_name'] ?? null,
                'beneficiary_relationship' => $traveler['beneficiary_relationship'] ?? null,
            ]);
        }
    }

    private function createTravelGuide(Booking $booking, array $data): void
    {
        $travelGuide = $booking->travelGuides()->create([
            'no_of_cities' => $data['num_of_cities'] ?? count($data['cities'] ?? []),
            'price' => $data['total_travel_guides_price'] ?? 0,
        ]);

        foreach ($data['cities'] ?? [] as $index=>$city) {
            $travelGuide->travelGuideDetails()->create([
                'guide' =>$data['city_names'][$index] ?? null,
                'price' => $city ?? null
            ]);
        }
    }
}
