<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyVerified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    private $baseUrl;
    private $serviceRole;

    public function __construct()
    {
        $this->baseUrl     = config('services.supabase.url');
        $this->serviceRole = config('services.supabase.service_role');
    }

    private function headers(): array
    {
        return [
            'apikey'        => $this->serviceRole,
            'Authorization' => 'Bearer ' . $this->serviceRole,
            'Content-Type'  => 'application/json',
        ];
    }

    public function dashboard()
    {
        $perusahaan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/perusahaan', [
                'select' => '*',
                'order'  => 'created_at.desc',
            ])->json();

        return view('admin.pages.dashboard', compact('perusahaan'));
    }

    public function companies()
    {
        $perusahaan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/perusahaan', [
                'select' => '*',
                'order'  => 'created_at.desc',
            ])->json();

        return view('admin.pages.companies.index', compact('perusahaan'));
    }

    public function showCompany(string $id)
    {
        $perusahaan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/perusahaan', [
                'perusahaan_id' => 'eq.' . $id,
                'select'        => '*',
            ])->json();

        if (empty($perusahaan)) {
            abort(404, 'Perusahaan tidak ditemukan');
        }

        $data = $perusahaan[0];
        return view('admin.pages.companies.show', compact('data'));
    }

    public function lowongan()
    {
        $lowongan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lowongan', [
                'select' => '*,jabatan(nama),jurusan(nama),tipe_pekerjaan(nama),sektor(nama),perusahaan(nama_perusahaan,kota)',
                'order'  => 'created_at.desc',
            ])->json();

        return view('admin.pages.lowongan.index', compact('lowongan'));
    }

    public function auditLog()
    {
        $logs = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/audit_log', [
                'select' => '*',
                'order'  => 'created_at.desc',
                'limit'  => 200,
            ])->json();

        return view('admin.pages.audit-log.index', compact('logs'));
    }

    public function verifyCompany(Request $request)
    {
        $request->validate([
            'id'     => 'required',
            'status' => 'required|in:accepted,rejected,pending',
        ]);

        $perusahaan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/perusahaan', [
                'perusahaan_id' => 'eq.' . $request->id,
                'select'        => 'email_perusahaan,nama_perusahaan',
            ])->json();

        if (empty($perusahaan)) {
            return back()->with('error', 'Perusahaan tidak ditemukan');
        }

        $res = Http::withHeaders($this->headers())
            ->post($this->baseUrl . '/rest/v1/rpc/verify_perusahaan', [
                'target_id'  => $request->id,
                'new_status' => $request->status,
            ]);

        if ($res->failed()) {
            return back()->with('error', 'Gagal verifikasi: ' . $res->body());
        }

        if (in_array($request->status, ['accepted', 'rejected'])) {
            Mail::to($perusahaan[0]['email_perusahaan'])
                ->send(new CompanyVerified(
                    $perusahaan[0]['nama_perusahaan'],
                    $request->status
                ));
        }

        $label = match($request->status) {  
            'accepted' => 'disetujui',
            'rejected' => 'ditolak',
            default    => 'diperbarui',
        };

        return redirect()->route('dashboard')->with('success', "Perusahaan berhasil {$label} dan email notifikasi telah dikirim");
    }
}
