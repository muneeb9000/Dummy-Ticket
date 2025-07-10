<?php



namespace App\Helpers;

use App\Models\Page;

class SeoHelper
{
    /**
     * Render SEO meta tags for a model (if provided), else for current URL's Page.
     *
     * @param  mixed|null $model
     * @return string
     */
    public static function render($model = null)
    {

        // If a model (like $blog or $page) is passed and has a `seo` relation
        if ($model && method_exists($model, 'seo') && $model->seo) {

            return view('components.seo-tags', [
                'model' => $model,
            ])->render();
        }

        // Fallback: Lookup Page by current URL
        $url = '/' . ltrim(request()->path(), '/').'/';

        $page = Page::where('url', $url)->first();
        if($page)
        {

        return view('components.seo-tags', [
            'model' => $page ,
        ])->render();
        }


        return seo()->render();
    }
}
