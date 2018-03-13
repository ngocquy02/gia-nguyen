<?php

namespace App\Http\Middleware;

use Closure;

class CheckPartner
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
        if (!Auth::guard('partner')->check()) {
            // return redirect()->route('');
        }
        return $next($request);
    }
}
