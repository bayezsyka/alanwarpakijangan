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
     * @param  string  ...$roles  // Parameter untuk role yang diizinkan (bisa lebih dari satu)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $userRoles = $request->user()->roles ?? [];

        // Cek apakah ada intersection antara roles user dan roles yang diizinkan
        if (count(array_intersect($userRoles, $roles)) === 0) {
            abort(403, 'AKSES DITOLAK. ANDA TIDAK MEMILIKI HAK AKSES.');
        }

        return $next($request);
    }
}
