<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsPenulis
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->isPenulis()) {
            abort(403, 'Anda tidak diizinkan mengakses halaman penulis.');
        }

        return $next($request);
    }
}
