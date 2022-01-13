<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->email != 'admin@admin.com') {
            return redirect(route('home'));
        }

        return $next($request);
    }
}
