<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
class Page extends Model
{
     use HasSEO;
    protected $fillable = [
        'url',
        'title',

    ];
    public function seo()
    {
        return $this->morphOne(\RalphJSmit\Laravel\SEO\Models\SEO::class, 'model');
    }
}
