<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Snippet;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

   public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('headerSnippets', Snippet::forPosition('head'));
            $view->with('bodySnippets', Snippet::forPosition('body'));
            $view->with('footerSnippets', Snippet::forPosition('footer'));
        });
    }
}

