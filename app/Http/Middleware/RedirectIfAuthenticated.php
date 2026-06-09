<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (! session('access_token')) {
            return $next($request);
        }

        $redirect = match (session('role')) {
            'admin' => redirect()->route('dashboard'),
            'perusahaan' => session('company_status') === 'accepted'
                ? redirect()->route('overview')
                : redirect()->route('company.profile'),
            default => null,
        };

        if ($redirect) {
            return $redirect;
        }

        session()->flush();

        return redirect()->route('login');
    }
}
