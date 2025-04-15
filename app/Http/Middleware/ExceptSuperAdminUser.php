<?php

namespace App\Http\Middleware;

use Closure;

class ExceptSuperAdminUser
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
        $userId = $request->segment(2);
        if ($userId == SUPER_ADMIN_ID) {
            abort(404);
        }
        return $next($request);
    }
}
