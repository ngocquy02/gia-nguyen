<?php

namespace App\Http\Middleware;

use Closure;
Use Auth;
Use App\User;

class Administrator
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
        return $next($request);
    }
}
