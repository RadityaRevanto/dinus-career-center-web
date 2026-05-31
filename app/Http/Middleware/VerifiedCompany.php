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

        if (!$data) {
            session()->flush();
            return redirect('/login')->with('error', 'Data perusahaan tidak ditemukan');
        }

        if ($data['status_verifikasi'] === 'rejected') {
            session(['company_status' => 'rejected']);
            return redirect()->route('company.profile')->with('error', 'Akun perusahaan Anda ditolak. Anda hanya dapat mengakses profil untuk memperbaiki data dan mengajukan review ulang.');
        }

        if ($data['status_verifikasi'] !== 'accepted') {
            session()->flush();
            return redirect('/login')->with('error', 'Akun perusahaan Anda sedang menunggu verifikasi admin');
        }

        session(['company_status' => 'accepted']);

        return $next($request);
    }
}
