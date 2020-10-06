<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class CheckToken
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
        if (empty(Session::get('admin_key'))) {
            return redirect('/logout');
        }
        return $next($request);
    }
}
