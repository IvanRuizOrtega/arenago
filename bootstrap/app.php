<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Src\Resources\Constants\Routes;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // FORZAR PROXIES DE CONFIANZA
        $middleware->trustProxies(at: '*');
        
        // Set a custom path for unauthenticated users
        $middleware->redirectGuestsTo(Routes::WELCOME);

        // OR use a named route
        $middleware->redirectGuestsTo(fn () => route(Routes::WELCOME));

        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
