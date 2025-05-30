<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\AuthorMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware; // Ensure this path matches the actual location of AdminMiddleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(AdminMiddleware::class);
        // $middleware->appendToGroup('admin', [
        //     AdminMiddleware::class
        // ]);
    })


    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(AuthorMiddleware::class);
        // $middleware->appendToGroup('author', [
        //     AuthorMiddleware::class
        // ]);
    })


    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
