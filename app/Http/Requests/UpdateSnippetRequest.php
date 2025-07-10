<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSnippetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|in:head,footer,body',
            'is_global' => 'sometimes|boolean',
            'page_route' => 'nullable|string|max:255',
            'code' => 'sometimes|required|string',
            'status' => 'nullable|in:active,inactive',

        ];
    }
}
