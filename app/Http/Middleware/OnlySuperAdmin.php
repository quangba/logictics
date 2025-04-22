<?php

namespace App\Http\Middleware;

use Closure;

class OnlySuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->id() !== SUPER_ADMIN_ID) {
            abort(404);
        }

        return $next($request);
    }
}
