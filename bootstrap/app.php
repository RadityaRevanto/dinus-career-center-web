<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // api: __DIR__.'/../routes/api.php',
         // Opsional: Tambahkan ini jika kamu punya API routes
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.supabase'              => \App\Http\Middleware\SupabaseAuth::class,
            'role'                       => \App\Http\Middleware\RoleMiddleware::class,
            'verified.company'           => \App\Http\Middleware\VerifiedCompany::class,
            'redirect.if.authenticated'  => \App\Http\Middleware\RedirectIfAuthenticated::class,
        ]);

        // Percayai header proxy (X-Forwarded-For) agar request()->ip()
        // mengembalikan IP asli pengunjung saat di belakang proxy/LB.
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // Menangani error Unauthenticated (401)
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated. Silakan login terlebih dahulu.',
                ], 401);
            }
        });

        // Menangani error Unauthorized/Forbidden dari Role (403)
        $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized. Anda tidak memiliki akses ke resource ini.',
                ], 403);
            }
        });

        // Menangani error Not Found (404)
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Resource tidak ditemukan.',
                ], 404);
            }
        });

    })->create();
