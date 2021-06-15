<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Subscribed
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() and !$request->user()->subscribed('default')) {
            return redirect()->route('checkout');
        }

        return $next($request);
    }
}
