<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( ! ($request->session()->has('id') && $request->session()->has('email') && $request->session()->has('isLogIn'))) {
            return redirect('/');
        }
        return $next($request);
    }
}
