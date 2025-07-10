<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

   public function rules(): array
    {
        return [
            'title'  => 'nullable|string|max:255',
            'review' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'status' => 'nullable|boolean',
        ];
    }

   public function messages(): array
    {
        return [
            'title.max'       => 'Please keep the review title short and simple.',
            'review.string'   => 'Please write something meaningful in your review.',
            'rating.required' => 'Please give a star rating.',
            'rating.integer'  => 'The rating must be a number.',
            'rating.min'      => 'Please give at least 1 star.',
            'rating.max'      => 'You can give up to 5 stars only.',
            'name.required'   => 'Please tell us your name.',
            'name.max'        => 'Please keep your name short.',
            'email.required'  => 'We need your email to stay in touch.',
            'email.email'     => 'Please enter a valid email address.',
            'email.max'       => 'Your email looks too long, try shortening it.',
        ];
    }

}
