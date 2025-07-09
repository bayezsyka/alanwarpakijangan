<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  // Parameter untuk role yang diizinkan (admin/penulis)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika pengguna yang login rolenya tidak sama dengan role yang diizinkan
        if ($request->user()->role !== $role) {
            // Tolak akses dan tampilkan halaman 403 Forbidden
            abort(403, 'AKSES DITOLAK. ANDA TIDAK MEMILIKI HAK AKSES.');
        }

        // Jika rolenya sesuai, izinkan pengguna melanjutkan ke halaman
        return $next($request);
    }
}