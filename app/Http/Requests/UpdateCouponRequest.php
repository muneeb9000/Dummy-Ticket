<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => 'required|string|unique:coupons,code,' . $this->route('coupon')->id,
            'form' => 'nullable|string',
            'percentage' => 'nullable|string',
            'status' => 'nullable|string',
            'usage_limit' => 'nullable|string',
            'expiry_date' => 'nullable|date',
            'flight' => 'nullable|string',
            'hotel'  => 'nullable|string',
            'insurance' => 'nullable|string',
            'guide' => 'nullable|string'
        ];
    }
}
