<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
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

    private function headers(): array
    {
        return [
            'apikey'        => $this->serviceRole,
            'Authorization' => 'Bearer ' . $this->serviceRole,
            'Content-Type'  => 'application/json',
        ];
    }

    public function show()
    {
        $perusahaanId = session('user')['id'];

        $perusahaan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/perusahaan', [
                'perusahaan_id' => 'eq.' . $perusahaanId,
                'select'        => '*',
            ])->json();

        $data = $perusahaan[0] ?? [];

        return view('company.pages.profile.profile', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_perusahaan'   => 'required',
            'nama_cp'           => 'required',
            'jabatan'           => 'required',
            'no_handphone'      => 'required',
            'alamat_perusahaan' => 'required',
            'kota'              => 'required',
            'kode_pos'          => 'required',
            'logo'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $perusahaanId = session('user')['id'];
        $logo = null;

        $perusahaan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/perusahaan', [
                'perusahaan_id' => 'eq.' . $perusahaanId,
                'select'        => 'status_verifikasi',
            ])->json();

        $statusVerifikasi = $perusahaan[0]['status_verifikasi'] ?? session('company_status');

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file      = $request->file('logo');
            $fileName  = $perusahaanId . '_' . time() . '.' . $file->getClientOriginalExtension();
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

        $payload = [
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
        ];

        if ($logo) {
            $payload['logo'] = $logo;
        }

        if ($statusVerifikasi === 'rejected') {
            $payload['status_verifikasi'] = 'pending';
        }

        $res = Http::withHeaders($this->headers())
            ->patch($this->baseUrl . '/rest/v1/perusahaan?perusahaan_id=eq.' . $perusahaanId, $payload);

        if ($res->failed()) {
            return back()->with('error', 'Gagal memperbarui profil: ' . $res->body())->withInput();
        }

        if ($statusVerifikasi === 'rejected') {
            session()->flush();
            return redirect('/login')->with('success', 'Profil berhasil diperbarui dan dikirim ulang untuk review admin. Silakan tunggu verifikasi berikutnya.');
        }

        return redirect()->route('company.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function password()
    {
        return view('company.pages.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password'         => 'required|string|min:8|confirmed|different:current_password',
        ], [
            'password.different' => 'Password baru harus berbeda dari password saat ini.',
        ]);

        $email = session('email') ?? data_get(session('user'), 'email');

        if (! $email) {
            return back()->with('error', 'Email akun tidak ditemukan di session. Silakan login ulang.');
        }

        $verify = Http::withHeaders([
            'apikey'       => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/auth/v1/token?grant_type=password', [
            'email'    => $email,
            'password' => $request->current_password,
        ]);

        if ($verify->failed()) {
            return back()->with('error', 'Password saat ini tidak sesuai.')->withInput();
        }

        $accessToken = $verify->json('access_token') ?? session('access_token');

        $update = Http::withHeaders([
            'apikey'        => $this->apiKey,
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type'  => 'application/json',
        ])->put($this->baseUrl . '/auth/v1/user', [
            'password' => $request->password,
        ]);

        if ($update->failed()) {
            return back()->with('error', 'Gagal mengubah password: ' . $update->body());
        }

        session()->flush();

        return redirect()->route('login')->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }
}
