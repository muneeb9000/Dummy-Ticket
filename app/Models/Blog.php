<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Blog extends Model
{
    use HasSEO;
    protected $fillable = [
        'image',
        'title',
        'media_id',
        'content',
        'category_id',
        'slug',
    ];
    public function seo()
    {
        return $this->morphOne(\RalphJSmit\Laravel\SEO\Models\SEO::class, 'model');
    }

    public function media()
    {
        return $this->belongsTo(Gallery::class, 'media_id');
    }

    public function categoryRelation()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }


}
