<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsStudent
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || !$request->user()->isStudent()) {
            return redirect('/');
        }

        return $next($request);
    }
}
