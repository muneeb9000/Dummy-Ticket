<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'creator_id', 'code', 'form', 'percentage',
        'status', 'usage_limit', 'expiry_date','coupon_usage','flight','hotel','insurance','guide'
    ];

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'creator_id');
    }

    protected $casts = [
        'expiry_date' => 'date',
        'usage' => 'integer',
        'usage_limit' => 'integer',
    ];
}
