<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::User()->role->id == 2) {

            // Check if the user has the 'author' role
            return $next($request);
            // return redirect('/')->with('error', 'You do not have author access.');
        } else {
            return redirect()->route(route: 'login')->with('error', 'You do not have author access.');
        }
    }
}
