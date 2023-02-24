<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoggedMiddleware
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
        // if user is logged go to next request
        if ($request->session()->get('logged'))
        {
            return $next($request);
        }

        // otherwise redirect to home
        return redirect('news');
    }
}
