<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;

class DetectDevice
{
    public function handle($request, Closure $next)
    {
        $agent = new Agent();

        $isMobile = $agent->isMobile();

        \Log::info('Device Detection:', ['mobile' => $isMobile]);

        session(['is_mobile' => $isMobile]);

        return $next($request);
    }
}
