<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InTest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('in-exam')->check()) {
            return $next($request);
        }
        return abort(403);
    }
}
