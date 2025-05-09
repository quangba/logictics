<?php

namespace App\Http\Middleware;

use Closure;

class CheckCarrierPermission
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
        $user = auth()->user();

        if ($user->id == SUPER_ADMIN_ID) {
            return $next($request);
        }
        $action = $request->route()->getActionMethod();

        $managerCarrierActions = ['index', 'create', 'store', 'edit', 'update', 'search', 'show'];
        $viewerAndAddActions = ['index', 'create', 'store', 'search', 'show'];
        $viewerActions = ['index', 'show', 'search'];
        if ($user->hasPermissionTo('manage_carrier') && in_array($action, $managerCarrierActions)) {
            return $next($request);
        }

        if ($user->hasPermissionTo('view_add_carrier') && in_array($action, $viewerAndAddActions)) {
            return $next($request);
        }

        if ($user->hasPermissionTo('view_carrier') && in_array($action, $viewerActions)) {
            return $next($request);
        }

        abort(403, 'Bạn không có quyền truy cập chức năng này.');
    }
}
