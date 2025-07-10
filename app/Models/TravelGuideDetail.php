<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelGuideDetail extends Model
{
    use HasFactory;

    protected $fillable = ['travel_guides_id', 'guide','price'];

    public function travelGuide()
    {
        return $this->belongsTo(TravelGuide::class, 'travel_guides_id');
    }
}