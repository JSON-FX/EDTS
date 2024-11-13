<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
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
        if (auth()->check() && auth()->user()->roles_id != 1) {
            return $next($request);
        }
        flash('Oops! Something went wrong. Please Contact Administrator.')->error();
        return back()->withInput();
    }
}
