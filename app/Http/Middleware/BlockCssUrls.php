<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockCssUrls
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $blockedPaths = [
            'wp-includes/css/dashicons.min.css',
            'wp-content/plugins/elements-plus/assets/css/ep-elements.css',
            'wp-content/plugins/elementor/assets/css/frontend-legacy.min.css',
            'wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css',
            'wp-content/plugins/easy-table-of-contents/assets/css/screen.min.css',
            'wp-content/uploads/elementor/css/custom-frontend.min.css',
            'wp-content/plugins/elementor-gravity-forms/assets/css/elementor-gravity-forms.css',
            'wp-content/plugins/Latest Post Grid/assets/style.css',
            'wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css',
            'wp-content/plugins/popup-maker/assets/css/pum-site.min.css',
            'wp-content/uploads/elementor/css/custom-pro-frontend.min.css',
            'wp-content/plugins/elementor/assets/lib/animations/animations.min.css',
            'wp-content/plugins/elementor/assets/lib/font-awesome/css/all.min.css',
            'wp-content/plugins/elementor/assets/lib/font-awesome/css/v4-shims.min.css',
            'wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css',
            'wp-content/plugins/ajax-search-lite/css/style-curvy-red.css',
            'wp-content/plugins/void-elementor-post-grid-addon-for-elementor-page-builder/assets/css/bootstrap.min.css',
            'wp-includes/css/dist/block-library/style.min.css',
            'wp-content/plugins/void-elementor-post-grid-addon-for-elementor-page-builder/assets/css/main.css',
            'wp-content/plugins/ajax-search-lite/css/style.basic.css',
            'wp-content/plugins/wp-masonry-layout/css/wmlc_client.css',
            'wp-content/plugins/elementor/assets/lib/font-awesome/css/brands.min.css',
            'wp-content/plugins/search-filter/style.css',
            'wp-content/plugins/sticky-header-effects-for-elementor/assets/css/she-header-style.css',
            'wp-content/plugins/flat-preloader/assets/css/flat-preloader-public.css',
            'wp-content/plugins/site-reviews/assets/styles/default.css',
            'wp-content/uploads/elementor/css/post-2292.css',
            'wp-content/et-cache/global/et-divi-customizer-global-1745419321142.min.css',
            'wp-content/et-cache/global/et-divi-customizer-global-17448963659877.min.css',
            'wp-content/et-cache/global/et-divi-customizer-global-17428266590757.min.css',
            'wp-content/et-cache/global/et-divi-customizer-global-17423837443615.min.css',
        ];

        foreach ($blockedPaths as $path) {
            if (str_contains($request->path(), $path)) {
                return response('Gone', 410);
            }
        }

        return $next($request);
    }
}
