<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaFlag extends Model
{
    protected $fillable = ['image','name','link','alt'];
   
    public function getGetImageAttribute()
    {
        return "storage/".$this->image;
    }

    public function media()
    {
        return $this->belongsTo(Gallery::class, 'media_id');
    }
}
