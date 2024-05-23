<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class adminLogIn
{
    /**
     * Handle an incoming request->url().
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('signinID')) {
            if (in_array($request->route()->getName(), ['signin', 'register'])) {
                return back();
            }
        } else {
        }
        return $next($request);
    }

}
