<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelerDetail extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'title', 'first_name', 'last_name'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}