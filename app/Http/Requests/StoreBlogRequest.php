<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;




class StoreBlogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image'             => 'nullable|string|max:255',
            'media_id'          => 'nullable|string|max:255',
            'title'             => 'required|string|max:255',
            'content'           => 'required',
            'category_id'       => 'required|string|max:255',
            'meta_title'        => 'nullable|string|max:70',
            'meta_description'  => 'nullable|string|max:160',
            'meta_keywords'     => 'nullable|string|max:255',
            'focus_keyword'     => 'nullable|string|max:100',
            'meta_image'        => 'nullable|string|max:255',
            'robots'            => 'nullable|string|max:32',
            'slug' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/i',
                Rule::unique('blogs', 'slug')
            ],
        ];
    }
}
