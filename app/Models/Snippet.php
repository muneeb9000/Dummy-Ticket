<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    protected $fillable = ['name', 'type', 'is_global', 'page_route', 'code', 'status'];

  public static function forPosition(string $type)
    {
        // This gives you "/thank-you" (including leading slash)
        $uri = request()->getPathInfo();

        return self::where('type', $type)
            ->where('status', 'active')
            ->where(function ($q) use ($uri) {
                $q->where('is_global', true)
                    ->orWhere('page_route', $uri);
            })
            ->orderBy('is_global', 'desc')
            ->orderBy('is_global', 'desc')
            ->get();
    }

}
