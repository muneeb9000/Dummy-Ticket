<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $adminId = $this->route('admin') ? $this->route('admin')->id : $this->input('id');
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('admins', 'email')->ignore($adminId),
            ],
            'role' => 'sometimes|required|exists:roles,id',
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'password_confirmation' => 'required_with:password'
        ];
    }
}