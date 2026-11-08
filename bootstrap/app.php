<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',          // ⬅️ ROUTE API
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Alias middleware
        $middleware->alias([
            'role'     => \App\Http\Middleware\CheckRole::class,
            'auth.api' => \App\Http\Middleware\ApiTokenMiddleware::class, // ⬅️ AUTH API TOKEN
            'penulis'  => \App\Http\Middleware\EnsureUserIsPenulis::class,
        ]);

        // Middleware visitor log untuk web
        $middleware->appendToGroup('web', \App\Http\Middleware\LogVisitorMiddleware::class);
        $middleware->appendToGroup('web', \App\Http\Middleware\HandleInertiaRequests::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
