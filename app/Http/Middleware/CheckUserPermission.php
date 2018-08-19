<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // first method get user id
//            var_dump($request->user);
        // second method get user id:
//            var_dump(\Request::segment(2));


        if (! Auth::check() || $request->user != Auth::id()) {
            abort(403, 'Brak dostępu');
        }
        return $next($request);
    }
}
