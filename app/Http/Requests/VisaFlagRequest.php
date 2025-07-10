<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisaFlagRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'nullable|image|max:2048',
            'alt' => 'required|string'
        ];
    }
}
