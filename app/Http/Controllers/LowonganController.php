<?php

namespace App\Http\Controllers;

use App\Support\LamaranHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class LowonganController extends Controller
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

    private function getMasterData(): array
    {
        $jabatan        = Http::withHeaders($this->headers())->get($this->baseUrl . '/rest/v1/jabatan', ['select' => 'jabatan_id,nama', 'order' => 'nama.asc'])->json();
        $jurusan        = Http::withHeaders($this->headers())->get($this->baseUrl . '/rest/v1/jurusan', ['select' => 'jurusan_id,nama', 'order' => 'nama.asc'])->json();
        $tipePekerjaan  = Http::withHeaders($this->headers())->get($this->baseUrl . '/rest/v1/tipe_pekerjaan', ['select' => 'tipe_pekerjaan_id,nama', 'order' => 'nama.asc'])->json();
        $sektor         = Http::withHeaders($this->headers())->get($this->baseUrl . '/rest/v1/sektor', ['select' => 'sektor_id,nama', 'order' => 'nama.asc'])->json();

        return compact('jabatan', 'jurusan', 'tipePekerjaan', 'sektor');
    }

    private function syncExpiredLowonganStatus(array $lowongan, string $perusahaanId): array
    {
        foreach ($lowongan as $index => $item) {
            if (($item['status_loker'] ?? '') !== 'aktif') {
                continue;
            }

            if (!LamaranHelper::isLowonganExpired($item['batas_akhir'] ?? null)) {
                continue;
            }

            Http::withHeaders($this->headers())
                ->patch($this->baseUrl . '/rest/v1/lowongan?lowongan_id=eq.' . $item['lowongan_id'] . '&perusahaan_id=eq.' . $perusahaanId, [
                    'status_loker' => 'tidak',
                    'updated_at'   => Carbon::now()->toIso8601String(),
                ]);

            $lowongan[$index]['status_loker'] = 'tidak';
        }

        return $lowongan;
    }

    public function index()
    {
        $perusahaanId = session('user')['id'];

        $lowongan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lowongan', [
                'perusahaan_id' => 'eq.' . $perusahaanId,
                'select'        => '*,jabatan(nama),jurusan(nama),tipe_pekerjaan(nama),sektor(nama)',
                'order'         => 'created_at.desc',
            ])->json();

        $lowongan = is_array($lowongan) ? $lowongan : [];
        $lowongan = $this->syncExpiredLowonganStatus($lowongan, $perusahaanId);
        $lowonganIds = array_column($lowongan, 'lowongan_id');
        $acceptedCounts = LamaranHelper::fetchAcceptedCounts($this->baseUrl, $this->headers(), $lowonganIds);

        return view('company.pages.jobs.index', compact('lowongan', 'acceptedCounts'));
    }

    public function create()
    {
        $masterData = $this->getMasterData();
        return view('company.pages.jobs.create', $masterData);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required',
            'jabatan_id'        => 'required',
            'jurusan_id'        => 'required',
            'tipe_pekerjaan_id' => 'required',
            'sektor_id'         => 'required',
            'batas_akhir'       => 'required|date',
            'jumlah_person'     => 'required|integer|min:1',
        ]);

        $perusahaanId = session('user')['id'];

        $res = Http::withHeaders($this->headers())
            ->post($this->baseUrl . '/rest/v1/lowongan', [
                'perusahaan_id'     => $perusahaanId,
                'jabatan_id'        => (int) $request->jabatan_id,
                'jurusan_id'        => (int) $request->jurusan_id,
                'tipe_pekerjaan_id' => (int) $request->tipe_pekerjaan_id,
                'sektor_id'         => (int) $request->sektor_id,
                'judul'             => $request->judul,
                'detail_lowongan'   => $request->detail_lowongan,
                'requirements'      => $request->requirements,
                'jumlah_person'     => (int) $request->jumlah_person,
                'range_gaji'        => $request->range_gaji,
                'batas_akhir'       => $request->batas_akhir,
                'status_loker'      => 'aktif',
            ]);

        if ($res->failed()) {
            return back()->with('error', 'Gagal membuat lowongan: ' . $res->body())->withInput();
        }

        return redirect()->route('jobs')->with('success', 'Lowongan berhasil dibuat!');
    }

    public function edit(string $id)
    {
        $perusahaanId = session('user')['id'];

        $lowongan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lowongan', [
                'lowongan_id'   => 'eq.' . $id,
                'perusahaan_id' => 'eq.' . $perusahaanId,
                'select'        => '*',
            ])->json();

        if (empty($lowongan)) {
            abort(403, 'Akses ditolak');
        }

        $lowongan = $this->syncExpiredLowonganStatus($lowongan, $perusahaanId)[0];
        $acceptedCount = LamaranHelper::countAcceptedForLowongan($this->baseUrl, $this->headers(), $id);
        $lowonganStatus = LamaranHelper::resolveLowonganStatus($lowongan, $acceptedCount);

        $masterData = $this->getMasterData();
        return view('company.pages.jobs.edit', array_merge([
            'lowongan' => $lowongan,
            'lowonganStatus' => $lowonganStatus,
        ], $masterData));
    }

    public function show(string $id)
    {
        $perusahaanId = session('user')['id'];

        $lowongan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lowongan', [
                'lowongan_id'   => 'eq.' . $id,
                'perusahaan_id' => 'eq.' . $perusahaanId,
                'select'        => '*,jabatan(nama),jurusan(nama),tipe_pekerjaan(nama),sektor(nama)',
            ])->json();

        if (empty($lowongan)) {
            abort(403, 'Akses ditolak');
        }

        $lowongan = $this->syncExpiredLowonganStatus($lowongan, $perusahaanId)[0];

        $lamaran = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'lowongan_id' => 'eq.' . $id,
                'select'      => 'lamaran_id,status_terakhir,created_at,pelamar:pelamar_id(pelamar_id,nama_lengkap,email,foto_profil,nim,bidang)',
                'order'       => 'created_at.desc',
            ])->json();

        $lamaran = is_array($lamaran) ? $lamaran : [];

        $acceptedCount = LamaranHelper::countAcceptedForLowongan($this->baseUrl, $this->headers(), $id);
        $lowonganStatus = LamaranHelper::resolveLowonganStatus($lowongan, $acceptedCount);

        return view('company.pages.jobs.show', [
            'lowongan' => $lowongan,
            'lamaran'  => $lamaran,
            'lowonganStatus' => $lowonganStatus,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul'             => 'required',
            'jabatan_id'        => 'required',
            'jurusan_id'        => 'required',
            'tipe_pekerjaan_id' => 'required',
            'sektor_id'         => 'required',
            'batas_akhir'       => 'required|date',
            'jumlah_person'     => 'required|integer|min:1',
            'status_loker'      => 'required|in:aktif,tidak',
        ]);

        $perusahaanId = session('user')['id'];

        $res = Http::withHeaders($this->headers())
            ->patch($this->baseUrl . '/rest/v1/lowongan?lowongan_id=eq.' . $id . '&perusahaan_id=eq.' . $perusahaanId, [
                'jabatan_id'        => (int) $request->jabatan_id,
                'jurusan_id'        => (int) $request->jurusan_id,
                'tipe_pekerjaan_id' => (int) $request->tipe_pekerjaan_id,
                'sektor_id'         => (int) $request->sektor_id,
                'judul'             => $request->judul,
                'detail_lowongan'   => $request->detail_lowongan,
                'requirements'      => $request->requirements,
                'jumlah_person'     => (int) $request->jumlah_person,
                'range_gaji'        => $request->range_gaji,
                'batas_akhir'       => $request->batas_akhir,
                'status_loker'      => $request->status_loker,
            ]);

        if ($res->failed()) {
            return back()->with('error', 'Gagal update lowongan: ' . $res->body())->withInput();
        }

        return redirect()->route('jobs')->with('success', 'Lowongan berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $perusahaanId = session('user')['id'];

        Http::withHeaders($this->headers())
            ->delete($this->baseUrl . '/rest/v1/lowongan?lowongan_id=eq.' . $id . '&perusahaan_id=eq.' . $perusahaanId);

        return redirect()->route('jobs')->with('success', 'Lowongan berhasil dihapus!');
    }
}