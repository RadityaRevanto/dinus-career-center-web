<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    private $baseUrl;
    private $apiKey;
    private $serviceRole;

    public function __construct()
    {
        $this->baseUrl     = config('services.supabase.url');
        $this->apiKey      = config('services.supabase.key');
        $this->serviceRole = config('services.supabase.service_role');
    }

    // =====================
    // LOGIN (tambahkan cek status verifikasi perusahaan)
    // =====================
    public function login(Request $request)
    {
        $res = Http::withHeaders([
            'apikey'       => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/auth/v1/token?grant_type=password', [
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        if ($res->failed()) {
            $error = $res->json()['error_description'] ?? 'Login gagal';
            return back()->with('error', $error);
        }

        $data = $res->json();

        // Ambil profile
        $profiles = Http::withHeaders([
            'apikey'        => $this->serviceRole,
            'Authorization' => 'Bearer ' . $this->serviceRole,
            'Content-Type'  => 'application/json',
        ])->get($this->baseUrl . '/rest/v1/profiles', [
            'id'     => 'eq.' . $data['user']['id'],
            'select' => 'role,full_name,email',
        ])->json();

        if (empty($profiles)) {
            return back()->with('error', 'Profile tidak ditemukan');
        }

        $profile = $profiles[0];

        // Cek status verifikasi kalau role perusahaan
        if ($profile['role'] === 'perusahaan') {
            $perusahaan = Http::withHeaders([
                'apikey'        => $this->serviceRole,
                'Authorization' => 'Bearer ' . $this->serviceRole,
                'Content-Type'  => 'application/json',
            ])->get($this->baseUrl . '/rest/v1/perusahaan', [
                'perusahaan_id' => 'eq.' . $data['user']['id'],
                'select'        => 'status_verifikasi,nama_perusahaan',
            ])->json();

            $status = $perusahaan[0]['status_verifikasi'] ?? 'pending';

            if ($status === 'pending') {
                return back()->with('error', 'Akun perusahaan Anda sedang menunggu verifikasi admin');
            }

            if ($status === 'rejected') {
                return back()->with('error', 'Akun perusahaan Anda ditolak. Hubungi admin untuk info lebih lanjut');
            }
        }

        // Simpan session
        session([
            'access_token' => $data['access_token'],
            'user'         => $data['user'],
            'role'         => $profile['role'],
            'full_name'    => $profile['full_name'],
        ]);

        return match ($profile['role']) {
            'admin'      => redirect()->route('dashboard'),
            'perusahaan' => redirect()->route('overview'),
            default      => redirect('/pelamar'),
        };
    }

    // =====================
    // REGISTER PERUSAHAAN
    // =====================
    public function registerCompany(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'           => 'required|email',
            'password'        => 'required|min:8',
            'nama_perusahaan' => 'required',
            'nama_cp'         => 'required',
            'jabatan'         => 'required',
            'no_handphone'    => 'required',
            'alamat_perusahaan' => 'required',
            'kota'            => 'required',
            'kode_pos'        => 'required',
        ]);

        // 1. Register ke Supabase Auth
        $res = Http::withHeaders([
            'apikey'       => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/auth/v1/signup', [
            'email'    => $request->email,
            'password' => $request->password,
            'data'     => [
                'role'      => 'perusahaan',
                'full_name' => $request->nama_perusahaan,
            ],
        ]);

        if ($res->failed()) {
            $error = $res->json()['error_description'] ?? 'Register gagal';
            return back()->with('error', $error)->withInput();
        }

        $data   = $res->json();

        $userId = $data['user']['id']
            ?? $data['session']['user']['id']
            ?? null;

        if (!$userId) {
            return back()->with('error', 'User tidak terbentuk: ' . json_encode($data))->withInput();
        }

        // 2. Insert ke profiles
        Http::withHeaders([
            'apikey'        => $this->serviceRole,
            'Authorization' => 'Bearer ' . $this->serviceRole,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'resolution=merge-duplicates,return=minimal',
        ])->post($this->baseUrl . '/rest/v1/profiles', [
            'id'        => $userId,
            'email'     => $request->email,
            'role'      => 'perusahaan',
            'full_name' => $request->nama_perusahaan,
        ]);

        // 2. Upsert tabel perusahaan dengan data lengkap
        $update = Http::withHeaders([
            'apikey'        => $this->serviceRole,
            'Authorization' => 'Bearer ' . $this->serviceRole,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'resolution=merge-duplicates,return=minimal',
        ])->post($this->baseUrl . '/rest/v1/perusahaan', [
            'perusahaan_id'        => $userId,
            'email_perusahaan'     => $request->email,
            'nama_perusahaan'      => $request->nama_perusahaan,
            'deskripsi_perusahaan' => $request->deskripsi_perusahaan,
            'website_perusahaan'   => $request->website_perusahaan,
            'jenis_penyedia'       => $request->jenis_penyedia,
            'alamat_perusahaan'    => $request->alamat_perusahaan,
            'kota'                 => $request->kota,
            'kode_pos'             => $request->kode_pos,
            'no_telepon'           => $request->no_telepon,
            'no_handphone'         => $request->no_handphone,
            'no_fax'               => $request->no_fax,
            'nama_cp'              => $request->nama_cp,
            'jabatan'              => $request->jabatan,
        ]);
        if ($update->failed()) {
            return back()->with('error', 'Gagal simpan data perusahaan: ' . $update->body())->withInput();
        }
       return redirect('/company-register')->with('success', 'Pendaftaran berhasil! Akun Anda sedang menunggu verifikasi admin sebelum bisa login.');
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
