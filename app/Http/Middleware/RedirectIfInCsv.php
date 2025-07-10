<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Redirect;

class RedirectIfInCsv
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUrl = $request->fullUrl();    // full URL
        $rule = Redirect::where('url', $currentUrl)->first();
        if ($rule) {
            return redirect()->away($rule->redirect_to, 301);
        }

        return $next($request);
    }
}
