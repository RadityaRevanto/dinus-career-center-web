<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            $errorData = $res->json() ?? [];
            $rawError = implode(' ', array_filter([
                $errorData['error_description'] ?? null,
                $errorData['msg'] ?? null,
                $errorData['message'] ?? null,
                $errorData['error'] ?? null,
            ]));
            $normalizedError = strtolower($rawError);
            $errorMessage = $rawError ?: 'Login gagal. Silakan coba lagi.';

            if (str_contains($normalizedError, 'invalid login credentials') || str_contains($normalizedError, 'invalid credentials')) {
                $profileByEmail = Http::withHeaders([
                    'apikey'        => $this->serviceRole,
                    'Authorization' => 'Bearer ' . $this->serviceRole,
                    'Content-Type'  => 'application/json',
                ])->get($this->baseUrl . '/rest/v1/profiles', [
                    'email'  => 'eq.' . $request->email,
                    'select' => 'id,email',
                    'limit'  => 1,
                ])->json();

                $errorMessage = empty($profileByEmail)
                    ? 'Email tidak terdaftar. Silakan cek kembali email Anda atau daftar akun baru.'
                    : 'Password salah. Silakan cek kembali kata sandi Anda.';
            }

            return back()->with('error', $errorMessage)->withInput($request->only('email'));
        }

        $data = $res->json();

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

        $companyStatus = null;

        if ($profile['role'] === 'perusahaan') {
            $perusahaan = Http::withHeaders([
                'apikey'        => $this->serviceRole,
                'Authorization' => 'Bearer ' . $this->serviceRole,
                'Content-Type'  => 'application/json',
            ])->get($this->baseUrl . '/rest/v1/perusahaan', [
                'perusahaan_id' => 'eq.' . $data['user']['id'],
                'select'        => 'status_verifikasi,nama_perusahaan',
            ])->json();

            $companyStatus = $perusahaan[0]['status_verifikasi'] ?? 'pending';

            if ($companyStatus === 'pending') {
                return back()->with('error', 'Akun perusahaan Anda sedang menunggu verifikasi admin');
            }
        }

        session([
            'access_token'   => $data['access_token'],
            'user'           => $data['user'],
            'role'           => $profile['role'],
            'full_name'      => $profile['full_name'],
            'email'          => $profile['email'] ?? ($data['user']['email'] ?? null),
            'logged_in_at'   => now()->toIso8601String(),
            'company_status' => $companyStatus,
        ]);

        return match ($profile['role']) {
            'admin'      => redirect()->route('dashboard'),
            'perusahaan' => $companyStatus === 'rejected'
                ? redirect()->route('company.profile')->with('error', 'Akun perusahaan Anda ditolak. Silakan perbaiki profil sesuai alasan penolakan di email, lalu simpan ulang untuk diajukan review.')
                : redirect()->route('overview'),
            default      => redirect('/pelamar'),
        };
    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $profile = Http::withHeaders([
            'apikey'        => $this->serviceRole,
            'Authorization' => 'Bearer ' . $this->serviceRole,
            'Content-Type'  => 'application/json',
        ])->get($this->baseUrl . '/rest/v1/profiles', [
            'email'  => 'eq.' . $request->email,
            'select' => 'id,email,full_name',
            'limit'  => 1,
        ])->json();

        if (empty($profile)) {
            return back()
                ->with('error', 'Email tidak terdaftar. Silakan cek kembali email Anda atau daftar akun baru.')
                ->withInput($request->only('email'));
        }

        $redirectTo = route('password.reset');

        $res = Http::withHeaders([
            'apikey'        => $this->serviceRole,
            'Authorization' => 'Bearer ' . $this->serviceRole,
            'Content-Type'  => 'application/json',
        ])->post($this->baseUrl . '/auth/v1/admin/generate_link', [
            'type'         => 'recovery',
            'email'        => $request->email,
            'redirect_to'  => $redirectTo,
        ]);

        if ($res->failed()) {
            $errorData = $res->json() ?? [];
            Log::warning('Supabase generate recovery link failed', [
                'status' => $res->status(),
                'error'  => $errorData ?: $res->body(),
            ]);

            return back()
                ->with('error', 'Gagal membuat link reset password. Silakan coba beberapa saat lagi.')
                ->withInput($request->only('email'));
        }

        $data = $res->json() ?? [];
        $resetLink = $data['action_link']
            ?? ($data['properties']['action_link'] ?? null);

        if (empty($resetLink)) {
            Log::error('Supabase recovery link missing action_link', ['response' => $data]);

            return back()
                ->with('error', 'Gagal membuat link reset password. Silakan coba beberapa saat lagi.')
                ->withInput($request->only('email'));
        }

        $userName = $profile[0]['full_name'] ?? 'Pengguna';
        $fromAddress = config('mail.from.address');
        $fromName = config('mail.from.name', 'Dinus Career Center');

        try {
            Mail::send('emails.password-reset', [
                'userName'  => $userName,
                'resetLink' => $resetLink,
            ], function ($message) use ($request, $fromAddress, $fromName, $userName) {
                $message->from($fromAddress, $fromName)
                    ->to($request->email, $userName)
                    ->subject('Reset Password - Dinus Career Center');
            });
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email reset password', [
                'email' => $request->email,
                'error' => $e->getMessage(),
            ]);

            return back()
                ->with('error', 'Gagal mengirim email reset password. Pastikan konfigurasi SMTP di file .env sudah benar.')
                ->withInput($request->only('email'));
        }

        return back()->with('success', 'Link reset password sudah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'access_token' => 'required|string',
            'password'     => 'required|min:8|confirmed',
        ]);

        $res = Http::withHeaders([
            'apikey'        => $this->apiKey,
            'Authorization' => 'Bearer ' . $request->access_token,
            'Content-Type'  => 'application/json',
        ])->put($this->baseUrl . '/auth/v1/user', [
            'password' => $request->password,
        ]);

        if ($res->failed()) {
            $errorData = $res->json() ?? [];
            Log::warning('Supabase reset password failed', [
                'status' => $res->status(),
                'error'  => $errorData ?: $res->body(),
            ]);

            return back()->with('error', 'Gagal mengubah password. Link mungkin sudah kedaluwarsa, silakan minta link baru.');
        }

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login dengan password baru.');
    }

public function registerCompany(Request $request)
{
    $request->validate([
        'email'             => 'required|email',
        'password'          => 'required|min:8',
        'nama_perusahaan'   => 'required',
        'nama_cp'           => 'required',
        'jabatan'           => 'required',
        'no_handphone'      => 'required',
        'alamat_perusahaan' => 'required',
        'kota'              => 'required',
        'kode_pos'          => 'required',
        'logo'              => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

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
        $errorCode = $res->json()['error_code'] ?? '';
        
        $error = match($errorCode) {
            'user_already_exists' => 'Email sudah terdaftar, gunakan email lain.',
            'invalid_email'       => 'Format email tidak valid.',
            'weak_password'       => 'Password terlalu lemah, minimal 8 karakter.',
            default               => $res->json()['msg'] ?? 'Register gagal.',
        };

        return back()->with('error', $error)->withInput();
    }

    $data   = $res->json();
    $userId = $data['user']['id']
        ?? $data['session']['user']['id']
        ?? null;

    if (!$userId) {
        return back()->with('error', 'User tidak terbentuk: ' . json_encode($data))->withInput();
    }

    $logo = null;

    if ($request->hasFile('logo')) {
        $file      = $request->file('logo');
        $fileName  = $userId . '_' . time() . '.' . $file->getClientOriginalExtension();
        $fileBytes = file_get_contents($file->getRealPath());

        $uploadRes = Http::withHeaders([
            'apikey'        => $this->serviceRole,
            'Authorization' => 'Bearer ' . $this->serviceRole,
            'Content-Type'  => $file->getMimeType(),
        ])->withBody($fileBytes, $file->getMimeType())
          ->post($this->baseUrl . '/storage/v1/object/logo-perusahaan/' . $fileName);

        if ($uploadRes->successful()) {
            $logo = $this->baseUrl . '/storage/v1/object/public/logo-perusahaan/' . $fileName;
        }
    }

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
        'logo'                 => $logo,
    ]);

    if ($update->failed()) {
        return back()->with('error', 'Gagal simpan data perusahaan: ' . $update->body())->withInput();
    }

    return redirect('/company-register')->with('success', 'Pendaftaran berhasil! Akun Anda sedang menunggu verifikasi admin sebelum bisa login.');
}

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
