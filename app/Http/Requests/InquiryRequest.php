<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'    => 'required|string|max:255',
            'number'  => 'required|string|max:20',
            'email'   => 'required|email',
            'status'  => 'required|string',
            'purpose' => 'required|string',
            'detail'  => 'required'
        ];
    }

   public function messages()
    {
        return [
            'name.required'     => 'Please enter your name.',
            'name.string'       => 'Name should be text only.',
            'name.max'          => 'That name looks a little too long.',

            'number.required'   => 'Please enter your contact number.',
            'number.string'     => 'That doesn’t look like a valid number.',
            'number.max'        => 'Please enter a shorter number.',

            'email.required'    => 'Please enter your email address.',
            'email.email'       => 'That doesn’t look like a valid email.',

            'status.required'   => 'Please choose your status.',
            'status.string'     => 'Please select a valid status.',

            'purpose.required'  => 'Please tell us the purpose of your message.',
            'purpose.string'    => 'The purpose should be written in text.',

            'detail.required'   => 'Please share a few more details.',
        ];
    }

}
