<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSnippetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:head,footer,body',
            'is_global' => 'boolean',
            'page_route' => 'nullable|string|max:255',
            'code' => 'required|string',
            'status' => 'required|in:active,inactive',
        ];
    }
}
