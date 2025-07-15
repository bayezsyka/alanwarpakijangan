<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class LogVisitorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();

        if (!Visitor::where('ip_address', $ip)->whereDate('visited_at', now())->exists()) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}
