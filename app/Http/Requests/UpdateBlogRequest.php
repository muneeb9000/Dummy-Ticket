<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'nullable',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|string|max:255',
            'media_id' => 'nullable|string|max:255',
            'slug'=> 'nullable|string'
        ];
    }
}
