<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkUser
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
        if (auth()->user()->status == '1' && auth()->user()->role == 'admin') {
            return $next($request);
        }elseif(auth()->user()->status == '1' && auth()->user()->role == 'driver'){
           return abort(431);
        }
           return abort(430);
    }
}
