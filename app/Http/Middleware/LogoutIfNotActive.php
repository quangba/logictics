<?php

namespace App\Http\Middleware;

use App\Entities\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutIfNotActive
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->getAttribute('active')) {
            Auth::logout();
            return redirect('/');
        }

        return $next($request);
    }
}
