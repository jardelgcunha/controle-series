<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Autenticador
{
    public function handle(Request $request, \Closure $next)
    {
        if (!Auth::check()) {
            throw new AuthenticationException();
        }
        return $next($request);
    }
}
