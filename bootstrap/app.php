<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
use App\Http\Middleware\DecryptUrlParameters;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Add URL parameter decryption middleware globally
        $middleware->append(DecryptUrlParameters::class);

        // Register route middleware aliases for Spatie permissions
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle SMTP/Mail transport exceptions globally
        $exceptions->renderable(function (TransportExceptionInterface $e, $request) {
            Log::error('Mail transport error: ' . $e->getMessage(), [
                'url' => $request->url(),
                'error_code' => $e->getCode(),
            ]);

            $message = 'We are unable to send emails at this time. Please try again later.';

            // Check for Gmail daily limit exceeded
            if (str_contains($e->getMessage(), 'Daily user sending limit exceeded') ||
                str_contains($e->getMessage(), '550-5.4.5')) {
                $message = 'Our email service is temporarily unavailable due to high demand. Please try again in a few hours or contact support.';
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], 503);
            }

            return back()->withErrors(['error' => $message]);
        });
    })->create();
