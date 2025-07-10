<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            $request->expectsJson() ? null : $this->CustomRedirectTo( $guards),
        );
    }

    protected function CustomRedirectTo($guards)
    {
        if (in_array('admin', $guards ?? [])) {
            return route('admin.login');
        }
        return route('login');
    }
}
