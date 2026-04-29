<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VerifiedCompany
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'perusahaan') {
            return $next($request);
        }

        $baseUrl = config('services.supabase.url');
        $serviceRole = config('services.supabase.service_role');

        $userId = session('user.id');

        $res = Http::withHeaders([
            'apikey'        => $serviceRole,
            'Authorization' => 'Bearer ' . $serviceRole,
        ])->get($baseUrl . '/rest/v1/perusahaan', [
            'perusahaan_id' => 'eq.' . $userId,
            'select'        => 'status_verifikasi',
        ]);

        if ($res->failed()) {
            return redirect('/login')->with('error', 'Gagal validasi akun');
        }

        $data = $res->json()[0] ?? null;

        if (!$data || $data['status_verifikasi'] !== 'accepted') {
            return redirect('/login')->with('error', 'Akun belum diverifikasi admin');
        }

        return $next($request);
    }
}
