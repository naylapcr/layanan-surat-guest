<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (Auth::check()) {
            // Pecah string role menjadi array. Contoh "super_admin,staff" jadi ['super_admin', 'staff']
            $allowedRoles = explode(',', $role);

            // Cek apakah role user yang login ada di dalam daftar role yang diperbolehkan
            if (in_array(Auth::user()->role, $allowedRoles)) {
                return $next($request);
            }
        }

        return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}

