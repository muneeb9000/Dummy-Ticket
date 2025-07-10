<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomPaymentRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'first_name'    => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|string|max:50',
            'order_number'  => 'required|string|max:100',
            'service_type'  => 'required|in:flight_correction,hotel_correction,flight_hotel_correction,flight_itinerary,hotel_booking,flight_hotel_both,travel_insurance,urgent_8h,urgent_6h',
            'custom_amount' => [
            'exclude_unless:service_type,flight_itinerary,hotel_booking,flight_hotel_both,travel_insurance',
            'numeric',
            'min:0.01',
        ],

        ];
    }
}
