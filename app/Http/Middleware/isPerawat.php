<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isPerawat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userRole = $request->session()->get('user_role');
        
        if ($userRole == 3) { // Role 3 = Perawat
            return $next($request);
        }
        
        return redirect()->route('home')->with('error', 'Akses ditolak. Anda bukan Perawat.');
    }
}
