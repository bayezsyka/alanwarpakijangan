<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Cek header Authorization: Bearer {token}
     */
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('Authorization');

        if (! $header || ! str_starts_with($header, 'Bearer ')) {
            return response()->json([
                'message' => 'Unauthorized (no token).',
            ], 401);
        }

        $plainToken = substr($header, 7);

        $token = ApiToken::where('token', $plainToken)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            })
            ->first();

        if (! $token) {
            return response()->json([
                'message' => 'Unauthorized (invalid token).',
            ], 401);
        }

        $user = $token->user;

        if (! $user) {
            return response()->json([
                'message' => 'Unauthorized (user not found).',
            ], 401);
        }

        // Set user ke Auth & request->user()
        Auth::setUser($user);
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}
