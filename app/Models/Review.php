<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'title',
        'review',
        'rating',
        'name',
        'email',
        'status',
        'created_at'
    ];

    protected $casts = [
        'status' => 'boolean',
        'rating' => 'integer',
        'created_at' => 'date',
    ];
}
