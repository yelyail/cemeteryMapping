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
    public function handle(Request $request, Closure $next) //if you already log in u should not get back to the login system
    {
        if ($request->session()->has('signinID') && (route('signin') == $request->route()->getName() || route('register') == $request->route()->getName())) {
            return back();
        }
        return $next($request);
    }
}
