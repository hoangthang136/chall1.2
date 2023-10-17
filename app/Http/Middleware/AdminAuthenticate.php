<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::check() and Auth::user()->role == 'Administrator');
        if (Auth::check()  and Auth::user()->role == 'Administrator') {
            return $next($request);
        }else {
            return Redirect()->route('admin.login')->with('error', 'Đăng nhập thất bại');
        }
        
    }
}
