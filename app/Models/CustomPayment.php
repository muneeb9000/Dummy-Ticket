<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomPayment extends Model
{
    protected $fillable = ['first_name','email','phone','order_number','service_type','custom_amount','status','ss_id'];
}
