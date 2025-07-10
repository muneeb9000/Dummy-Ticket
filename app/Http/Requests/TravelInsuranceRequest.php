<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TravelInsuranceRequest extends FormRequest
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
            'insurance_num_of_travelers' => 'required|integer|min:1|max:8',
            'interview_documents' => 'required',
            'future_delivery_date' => 'required_if:interview_documents,Schedule in Future Date|date',
            'referral_source' => 'nullable|string|max:255',

            'travel_insurance'      => 'required|in:yes,no',
            'insurance_title'       => 'required_if:travel_insurance,yes|required|string|in:Mr,Ms,Mrs,Dr',
            'insurance_first_name'  => 'required_if:travel_insurance,yes|required|string|max:255',
            'insurance_last_name'  => 'required_if:travel_insurance,yes|required|string|max:255',
            'start_date' => 'required_if:travel_insurance,yes|date|before_or_equal:end_date',
            'end_date'   => 'required_if:travel_insurance,yes|date|after_or_equal:start_date',
            'insurance_travelling_from'  => 'required_if:travel_insurance,yes|required|string|max:255',
            'insurance_travelling_to'  => 'required_if:travel_insurance,yes|required|string|max:255',
            'insurance_purpose'  => 'required_if:travel_insurance,yes|required|in:1,2',


            'insurance_travelers' => [
                'array',
                Rule::requiredIf(fn () => (int) $this->input('insurance_num_of_travelers') > 1),
                $this->validateTravellersCount(),
            ],
            'insurance_travelers.*.first_name' => 'required|string|max:255',
            'insurance_travelers.*.last_name' => 'required|string|max:255',
            'insurance_travelers.*.is_us_citizen' => 'required|in:1,2',
            'insurance_travelers.*.age_group' => 'required|in:1,2,3,4,5,10,15,20,25,30',
            'insurance_travelers.*.dob' => 'required|date|before:today',
            'insurance_travelers.*.gender' => 'required|in:Male,Female,Other',
            'insurance_travelers.*.citizenship' => 'required|string|max:100',
            'insurance_travelers.*.passport' => 'nullable|string|max:50',
            'insurance_travelers.*.home_country' => 'required|string|max:100',
            'insurance_travelers.*.home_country_address' => 'required|string|max:255',
            'insurance_travelers.*.home_country_state' => 'required|string|max:100',
            'insurance_travelers.*.home_country_city' => 'required|string|max:100',
            'insurance_travelers.*.home_country_postal_code' => 'required|string|max:20',
            'insurance_travelers.*.home_country_phone' => 'required|string|max:20',
            'insurance_travelers.*.beneficiary_name' => 'required|string|max:255',
            'insurance_travelers.*.beneficiary_relationship' => 'required|string|max:100',

            'flightReservation'      => 'required|in:yes,no',
            'flights'                => 'exclude_if:flightReservation,no|required|array',
            'flights.0'              => 'exclude_if:flightReservation,no|required|string|max:255',
            'flights.*'              => 'exclude_if:flightReservation,no|nullable|string|max:255',
            'extra_flights'          => 'exclude_if:flightReservation,no|nullable|integer|min:3|max:9',
            'travellers' => [
                'array',
                Rule::requiredIf(fn () => (int) $this->input('total_flight_reservation_travelers') > 1),
                $this->validateTravellersCount(),
            ],
            'travellers.*.title' => 'required|string|in:Mr.,Ms.,Mrs.,Dr.',
            'travellers.*.first_name' => 'required|string|max:255',
            'travellers.*.last_name' => 'required|string|max:255',
            'flight_additional_details' => 'exclude_if:flightReservation,no|nullable|string|max:2000',

            'hotelBooking'                  => 'required|in:yes,no',
            'hotels'                          => 'exclude_if:hotelBooking,no|array',
            'hotels.0'                        => 'exclude_if:hotelBooking,no|required|string|max:255',
            'hotels.*'                        => 'exclude_if:hotelBooking,no|nullable|string|max:255',
            'hotel_additional_details'        => 'exclude_if:hotelBooking,no|nullable|string|max:2000',


            'travel_guide'   => 'required|in:yes,no',
            'num_of_cities'  => 'required_if:travel_guide,yes|integer|min:1|max:5',
            'cities'         => 'required_if:travel_guide,yes|array|min:1',
            'cities.*'       => 'required|string|max:255',
            "urgent_reservation"=> 'nullable|integer||in:1,2',
        ];
    }

    protected function validateTravellersCount()
    {
        return function ($attribute, $value, $fail) {
            $total = (int) $this->input('total_travellers');
            $expected = $total > 1 ? $total - 1 : 0;

            if ($total > 1 && count((array) $value) !== $expected) {
                $fail("You must provide info for exactly {$expected} additional traveler(s).");
            }
        };
    }

    public function messages()
    {
        return [
            'insurance_travelers.*.title.required' => 'Each traveler must have a title.',
            'insurance_travelers.*.first_name.required' => 'Each traveler must have a first name.',
            'insurance_travelers.*.last_name.required' => 'Each traveler must have a last name.',
            '1st_flight.required_if' => 'The first flight field is required when flight reservation is selected.',
            'phone' => 'Phone must start with + and contain only numbers, spaces, or dashes.',


             'flightReservation.required'               => 'Please let us know if you need Flight Reservation.',
        'flightReservation.in'                     => 'Invalid selection for Flight Reservation.',

        'insurance_num_of_travelers.required'
            => 'You must select the number of travelers when flight reservation is “yes.”',
        'insurance_num_of_travelers.min'
            => 'At least one traveler is required.',
        'insurance_num_of_travelers.max'
            => 'You can book for up to 8 travelers.',

        'flights.0.required'
            => 'The first Flight is required when Flight Reservation is “yes.”',
        'flights.*.string'
            => 'Each Flight entry must be valid text.',
        'flights.*.max'
            => 'Flight entry may not exceed 255 characters.',

        'flight_additional_details.max'
            => 'Additional details may not exceed 1000 characters.',


       'hotelBooking.required'               => 'Please let us know if you need hotel bookings.',
        'hotelBooking.in'                     => 'Invalid selection for hotel booking.',

        'insurance_num_of_travelers.required'
            => 'You must select the number of travelers when Travel Insurance is “yes.”',
        'insurance_num_of_travelers.min'
            => 'At least one traveler is required.',
        'insurance_num_of_travelers.max'
            => 'You can book for up to 8 travelers.',

        'hotels.0.required'
            => 'The first hotel is required when hotel booking is “yes.”',
        'hotels.*.string'
            => 'Each hotel entry must be valid text.',
        'hotels.*.max'
            => 'Hotel entry may not exceed 255 characters.',

        'hotel_additional_details.max'
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
