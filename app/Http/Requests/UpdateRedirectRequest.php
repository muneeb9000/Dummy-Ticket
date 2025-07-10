<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRedirectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Strip trailing slashes off url & redirect_to before validation.
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
          
            'redirect_to' => [
                'required',
                'string',
                'url',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'url.required'    => 'The original URL is required.',
            'url.url'         => 'The original URL must be a valid absolute URL.',
            'url.unique'      => 'This original URL already has a redirect.',
            'redirect_to.required' => 'The redirect URL is required.',
            'redirect_to.url'      => 'The redirect URL must be a valid absolute URL.',
        ];
    }

    public function attributes(): array
    {
        return [
            'url'         => 'original URL',
            'redirect_to' => 'redirect URL',
        ];
    }
}
