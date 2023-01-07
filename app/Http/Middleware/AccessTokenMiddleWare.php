<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessTokenMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (request('access_token') == config('app.access_token')) {
            return $next($request);
        }
        abort(401, "Access token doesn't match");
    }
}
