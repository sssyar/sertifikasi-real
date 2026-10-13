<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login dan apakah rolenya sesuai
        if (!Auth::check() || Auth::user()->role !== $role) {
            if (Auth::check() && Auth::user()->role === 'user') {
                return redirect()->route('user.dashboard')->with('error', 'Akses ditolak. Anda bukan admin.');
            }
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
