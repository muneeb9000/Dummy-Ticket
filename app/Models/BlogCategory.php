<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = ['name','slug'];
    public function seo()
    {
        return $this->morphOne(\RalphJSmit\Laravel\SEO\Models\SEO::class, 'model');
    }
}
