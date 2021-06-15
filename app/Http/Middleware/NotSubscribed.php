<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotSubscribed
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() and $request->user()->subscribed('default')) {
            return redirect()->route('account');
        }

        return $next($request);
    }
}
