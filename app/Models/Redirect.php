<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
     protected $fillable = ['url', 'redirect_to'];
}
