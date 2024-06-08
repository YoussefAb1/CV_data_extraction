<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Barryvdh\DomPDF\Facade;


return Application::configure(basePath: dirname(__DIR__))
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => App\Http\Middleware\Role::class,
            'PDF' => Barryvdh\DomPDF\Facade::class,
            'Excel' => Maatwebsite\Excel\Facades\Excel::class,

        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();



