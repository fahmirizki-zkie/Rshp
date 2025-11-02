<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isPemilik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user tidak terautentikasi, redirect ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil role dari session
        $userRole = session('user_role');

        // Jika user adalah Pemilik (role 5), izinkan akses
        if ($userRole == 5) {
            return $next($request);
        }
        
        // Jika bukan pemilik, redirect ke login
        return redirect()->route('login')->with('error', 'Akses ditolak. Anda bukan pemilik.');
    }
}
