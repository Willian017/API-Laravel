<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->shouldRenderJsonWhen(function ($request, Throwable $e) {
            if ($request->is('api/*')) {
                return true;
            }
            return $request->expectsJson();
        });

        $exceptions->renderable(function (AuthenticationException $e, $request) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        });

        $exceptions->renderable(function (ValidationException $e, $request) {
            return response()->json([
                'message' => 'Erro de validação',
                'errors'  => $e->errors(),
            ], 422);
        });

        $exceptions->renderable(function (ModelNotFoundException $e, $request) {
            return response()->json([
                'message' => 'Registro não encontrado'
            ], 404);
        });
    })->create();
