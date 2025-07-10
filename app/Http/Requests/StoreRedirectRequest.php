<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRedirectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Strip any trailing slash off of url and redirect_to
     * before the rest of validation/creation happens.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('url')) {
            $this->merge([
                'url' => rtrim($this->input('url'), '/'),
            ]);
        }

        if ($this->has('redirect_to')) {
            $this->merge([
                'redirect_to' => rtrim($this->input('redirect_to'), '/'),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'url' => [
                'required',
                'string',
                'url',
                'unique:redirects,url',
                'max:255',
                function ($attribute, $value, $fail) {
                    // now both values are already trimmed of trailing slash
                    if ($value === $this->input('redirect_to')) {
                        $fail('The original and redirect URLs must be different.');
                    }
                }
            ],
            'redirect_to' => [
                'required',
                'string',
                'url',
                'max:255',
            ],
        ];
    }


}
