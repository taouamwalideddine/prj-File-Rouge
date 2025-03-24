<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsTeacher
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || !$request->user()->isTeacher()) {
            return redirect('/');
        }

        return $next($request);
    }
}
