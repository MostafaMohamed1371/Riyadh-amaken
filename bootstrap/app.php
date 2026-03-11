<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn () => url('/login'));
        $middleware->redirectUsersTo(fn () => url('/admin'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Ensure API routes always receive JSON error responses
        $exceptions->render(function (Throwable $e, Request $request) {
            if (! $request->is('api/*') && ! $request->expectsJson()) {
                return null;
            }

            if ($e instanceof ValidationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $e->errors(),
                ], 422);
            }

            if ($e instanceof AuthenticationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated.',
                ], 401);
            }

            if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                return response()->json([
                    'success' => false,
                    'message' => $e instanceof ModelNotFoundException
                        ? 'Resource not found.'
                        : 'Endpoint not found.',
                ], 404);
            }

            $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
            if ($status < 400 || $status >= 600) {
                $status = 500;
            }

            return response()->json([
                'success' => false,
                'message' => config('app.debug') ? $e->getMessage() : 'Server error.',
            ], $status);
        });
    })->create();
