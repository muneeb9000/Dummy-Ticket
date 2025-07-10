<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [

        'category_id',
        'question',
        'answer',
    ];

    public function category()
    {
        return $this->belongsTo(FaqCategory::class);
    }

}
