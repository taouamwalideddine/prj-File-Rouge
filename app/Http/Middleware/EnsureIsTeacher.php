<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EnsureIsTeacher
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || $user->role !== 'teacher') {
            return redirect('/');
        }

        if ($user->trashed()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your teacher account was rejected');
        }

        return $next($request);
    }
}
