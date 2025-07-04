<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = Cookie::get('login_token');
        
        if (!$token) {
            return redirect()->route('user.login')->with('message', 'Please login first');
        // } else {
        //     return redirect()->route('user-main');
        }

        return $next($request);
    }
}
