<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HotelBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            // User Info
            'title' => 'required|string|in:Mr,Ms,Mrs,Dr',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => [
                'required',
                'string',
                'min:8',
                'max:20',

            ],
            'total_hotel_booking_travelers' => 'required|integer|min:1|max:8',
            'interview_documents' => 'required',
            'future_delivery_date' => 'required_if:interview_documents,Schedule in Future Date|date',
            'referral_source' => 'nullable|string|max:255',

            'travellers' => [
                'array',
                Rule::requiredIf(fn () => (int) $this->input('total_hotel_booking_travellers') > 1),
                $this->validateTravellersCount(),
            ],
            'travellers.*.title' => 'required|string|in:Mr.,Ms.,Mrs.,Dr.',
            'travellers.*.first_name' => 'required|string|max:255',
            'travellers.*.last_name' => 'required|string|max:255',

            'hotelBooking'                  => 'required|in:yes,no',
            'hotels'                          => 'required|array',
            'hotels.0'                        => 'required|string|max:255',
            'hotels.*'                        => 'nullable|string|max:255',
            'hotel_additional_details'        => 'nullable|string|max:2000',


            'flightReservation'      => 'required|in:yes,no',
            // only when Flight Reservation === 'yes'

            'flights'                => 'exclude_if:flightReservation,no|required_if:flightReservation,yes|array',
            'flights.0'              => 'exclude_if:flightReservation,no|required_if:flightReservation,yes|string|max:255',
            'flights.*'              => 'exclude_if:flightReservation,no|nullable|string|max:255',
            'extra_flights'          => 'exclude_if:flightReservation,no|nullable|integer|min:3|max:9',
            'total_flight_reservation_travellers' => 'exclude_if:flightReservation,no|integer|min:1|max:8',
                    'flight_additional_details' => 'exclude_if:flightReservation,no|nullable|string|max:2000',

            'travel_insurance'                 => 'required|in:yes,no',

            // only if they opted in
            'insurance_title'                  => 'required_if:travel_insurance,yes|string|in:Mr,Mrs,Ms,Dr,Prof,Rev',
            'insurance_first_name'             => 'required_if:travel_insurance,yes|string|max:255',
            'insurance_last_name'              => 'required_if:travel_insurance,yes|string|max:255',

            'insurance_num_of_travelers'       => 'required_if:travel_insurance,yes|integer|min:1|max:8',
            'start_date'                       => 'required_if:travel_insurance,yes|date',
            'end_date'                         => 'required_if:travel_insurance,yes|date|after_or_equal:start_date',

            'insurance_travelling_from'        => 'required_if:travel_insurance,yes|string|max:255',
            'insurance_travelling_to'          => 'required_if:travel_insurance,yes|string|max:255',
            'insurance_purpose'                => 'required_if:travel_insurance,yes|in:1,2',

            'insurance_travelers'              => 'required_if:travel_insurance,yes|array|min:1',
            'insurance_travelers.*.first_name' => 'required|string|max:255',
            'insurance_travelers.*.last_name'  => 'required|string|max:255',
            'insurance_travelers.*.is_us_citizen'       => 'required|in:1,2',
            'insurance_travelers.*.age_group'           => 'required|integer',
            'insurance_travelers.*.dob'                 => 'required|date',
            'insurance_travelers.*.gender'              => 'required|in:Male,Female,Other',
            'insurance_travelers.*.citizenship'         => 'required|string|max:255',
            'insurance_travelers.*.passport'            => 'nullable|string|max:255',
            'insurance_travelers.*.home_country'        => 'required|string|max:255',
            'insurance_travelers.*.home_country_address'=> 'required|string|max:500',
            'insurance_travelers.*.home_country_state'  => 'required|string|max:255',
            'insurance_travelers.*.home_country_city'   => 'required|string|max:255',
            'insurance_travelers.*.home_country_postal_code' => 'required|string|max:50',
            'insurance_travelers.*.home_country_phone'  => 'required|string|max:50',
            'insurance_travelers.*.beneficiary_name'    => 'required|string|max:255',
            'insurance_travelers.*.beneficiary_relationship' => 'required|in:Spouse,Other',


        'travel_guide'   => 'required|in:yes,no',

        // only if they said “yes”
        'num_of_cities'  => 'required_if:travel_guide,yes|integer|min:1|max:5',
        'cities'         => 'required_if:travel_guide,yes|array|min:1',
        'cities.*'       => 'required|string|max:255',
        "urgent_reservation"=> 'nullable|integer||in:1,2',
        ];
    }

    protected function validateTravellersCount()
    {
        return function ($attribute, $value, $fail) {
            $total = (int) $this->input('total_hotel_booking_travellers');
            $expected = $total > 1 ? $total - 1 : 0;

            if ($total > 1 && count((array) $value) !== $expected) {
                $fail("You must provide info for exactly {$expected} additional traveler(s).");
            }
        };
    }

    public function messages()
    {
        return [
        'travellers.*.title.required' => 'Each traveler must have a title.',
        'travellers.*.first_name.required' => 'Each traveler must have a first name.',
        'travellers.*.last_name.required' => 'Each traveler must have a last name.',
        'phone' => 'Phone must start with + and contain only numbers, spaces, or dashes.',

        'hotels.required_if'    => 'Please add at least your first hotel when you select “yes” for hotel booking.',
        'hotels.0.required_if'  => 'The first hotel is required when you select “yes” for hotel booking.',
        'hotels.*.string'       => 'Each Hotel must be a valid text string.',
        'hotels.*.max'          => 'Each Hotel may not be longer than 255 characters.',

        'flights.required_if'    => 'Please add at least your first flight when you select “yes” for flight reservation.',
        'flights.0.required_if'  => 'The first flight is required when you select “yes” for flight reservation.',
        'flights.*.string'       => 'Each flight must be a valid text string.',
        'flights.*.max'          => 'Each flight may not be longer than 255 characters.',

       'flightReservation.required'               => 'Please let us know if you need Flight Reservation.',
        'flightReservation.in'                     => 'Invalid selection for Flight Reservation.',

        'total_flight_reservation_travelers.required'
            => 'You must select the number of travelers when flight reservation is “yes.”',
        'total_flight_reservation_travelers.min'
            => 'At least one traveler is required.',
        'total_flight_reservation_travelers.max'
            => 'You can book for up to 8 travelers.',

        'flights.0.required'
            => 'The first Flight is required when Flight Reservation is “yes.”',
        'flights.*.string'
            => 'Each Flight entry must be valid text.',
        'flights.*.max'
            => 'Flight entry may not exceed 255 characters.',

        'flight_additional_details.max'
            => 'Additional details may not exceed 1000 characters.',


            'travel_insurance.required'                   => 'Please indicate if you need travel medical insurance.',
        'travel_insurance.in'                         => 'Invalid choice for travel insurance.',

        'insurance_title.required_if'                 => 'Please select a title for your insurance.',
        'insurance_title.in'                          => 'Invalid title selected.',

        'insurance_first_name.required_if'            => 'First name is required when insurance is “yes.”',
        'insurance_last_name.required_if'             => 'Last name is required when insurance is “yes.”',

        'insurance_num_of_travelers.required_if'      => 'Please select the number of travelers.',
        'insurance_num_of_travelers.min'              => 'At least one traveler is required.',
        'insurance_num_of_travelers.max'              => 'You can insure up to 8 travelers.',

        'start_date.required_if'                      => 'Please choose a start date.',
        'end_date.required_if'                        => 'Please choose an end date.',
        'end_date.after_or_equal'                     => 'End date must be on or after the start date.',

        'insurance_travelling_from.required_if'       => 'Please specify your departure country.',
        'insurance_travelling_to.required_if'         => 'Please specify your destination country.',

        'insurance_purpose.required_if'               => 'Please select a purpose for the insurance.',
        'insurance_purpose.in'                        => 'Invalid insurance purpose.',

        'insurance_travelers.required_if'             => 'Please provide details for each traveler.',
        'insurance_travelers.*.first_name.required'   => 'Traveler first name is required.',
        'insurance_travelers.*.last_name.required'    => 'Traveler last name is required.',
        // … and so on for each sub-field …


        'travel_guide.required'              => 'Please let us know if you require a travel guide.',
        'travel_guide.in'                    => 'Invalid selection for travel guide.',

        'num_of_cities.required_if'          => 'Please select how many cities you need guides for.',
        'num_of_cities.integer'              => 'The number of cities must be a number.',
        'num_of_cities.min'                  => 'At least one city must be selected.',
        'num_of_cities.max'                  => 'You can select up to 5 cities only.',

        'cities.required_if'                 => 'Please choose at least one city.',
        'cities.*.required'                  => 'Each selected city is required.',
        'cities.*.string'                    => 'Invalid city format.',
        'cities.*.max'                       => 'City name may not exceed 255 characters.',

        ];
    }
}
