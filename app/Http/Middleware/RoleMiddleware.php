<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if ($role == 'admin' && Auth::check()) {
            // Jika pengguna sudah login, redirect ke dashboard
            return redirect()->route('dashboard');
        }

        if ($role == 'customer' && !Auth::check()) {
            // Jika pengguna belum login, redirect ke halaman login
            return redirect()->route('dashboard2');
        }


        if ($role == 'admin' && !Auth::check() ) {
            // Jika pengguna belum login, redirect ke halaman login
            return redirect()->route('logins')->with('error', 'You must be logged in to access this page');;
        }
        
        return $next($request);
    }

}
