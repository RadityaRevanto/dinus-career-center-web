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

    public function companies(Request $request)
    {
        $allPerusahaan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/perusahaan', [
                'select' => '*',
                'order'  => 'created_at.desc',
            ])->json();

        $allPerusahaan = is_array($allPerusahaan) ? $allPerusahaan : [];
        $statusFilter = $request->query('status', 'all');
        $allowedFilters = ['pending', 'accepted', 'rejected'];

        $filteredPerusahaan = in_array($statusFilter, $allowedFilters, true)
            ? collect($allPerusahaan)->where('status_verifikasi', $statusFilter)->values()->all()
            : $allPerusahaan;

        $perPageOptions = [10, 25, 50, 100];
        $perPage = (int) $request->query('per_page', 10);
        $perPage = in_array($perPage, $perPageOptions, true) ? $perPage : 10;

        $filteredTotal = count($filteredPerusahaan);
        $lastPage = max(1, (int) ceil($filteredTotal / $perPage));
        $currentPage = min(max(1, (int) $request->query('page', 1)), $lastPage);
        $items = array_slice($filteredPerusahaan, ($currentPage - 1) * $perPage, $perPage);

        $perusahaan = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $filteredTotal,
            $perPage,
            $currentPage,
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('admin.pages.companies.index', compact('perusahaan', 'allPerusahaan', 'statusFilter', 'filteredTotal', 'perPageOptions'));
    }

    public function showCompany(Request $request, string $id)
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

        $lowongan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lowongan', [
                'perusahaan_id' => 'eq.' . $id,
                'select'        => '*,jabatan(nama),jurusan(nama),tipe_pekerjaan(nama),sektor(nama)',
                'order'         => 'created_at.desc',
            ])->json();

        $allLowongan = is_array($lowongan) ? $lowongan : [];

        $totalLowongan = count($allLowongan);
        $lowonganAktif = collect($allLowongan)->where('status_loker', 'aktif')->count();
        $lowonganTutup = collect($allLowongan)->where('status_loker', 'tutup')->count();
        $lowonganPerPageOptions = [10, 25, 50, 100];
        $lowonganPerPage = (int) $request->query('per_page', 10);
        $lowonganPerPage = in_array($lowonganPerPage, $lowonganPerPageOptions, true) ? $lowonganPerPage : 10;

        $lastPage = max(1, (int) ceil($totalLowongan / $lowonganPerPage));
        $currentPage = min(max(1, (int) $request->query('page', 1)), $lastPage);
        $items = array_slice($allLowongan, ($currentPage - 1) * $lowonganPerPage, $lowonganPerPage);

        $lowongan = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $totalLowongan,
            $lowonganPerPage,
            $currentPage,
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('admin.pages.companies.show', compact('data', 'lowongan', 'totalLowongan', 'lowonganAktif', 'lowonganTutup', 'lowonganPerPageOptions'));
    }

    public function lowongan()
    {
        $lowongan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lowongan', [
                'select' => '*,jabatan(nama),jurusan(nama),tipe_pekerjaan(nama),sektor(nama),perusahaan(nama_perusahaan,kota)',
                'order'  => 'created_at.desc',
            ])->json();

        $lowongan = is_array($lowongan) ? $lowongan : [];
        $lowonganIds = collect($lowongan)->pluck('lowongan_id')->filter()->values()->all();
        $jumlahPelamar = [];

        if (!empty($lowonganIds)) {
            $lamaran = Http::withHeaders($this->headers())
                ->get($this->baseUrl . '/rest/v1/lamaran', [
                    'select'      => 'lowongan_id',
                    'lowongan_id' => 'in.(' . implode(',', $lowonganIds) . ')',
                ])->json();

            $jumlahPelamar = is_array($lamaran)
                ? collect($lamaran)->groupBy('lowongan_id')->map->count()->all()
                : [];
        }

        $lowongan = collect($lowongan)->map(function ($item) use ($jumlahPelamar) {
            $item['jumlah_pelamar'] = $jumlahPelamar[$item['lowongan_id'] ?? null] ?? 0;
            return $item;
        })->all();

        $totalLowongan = count($lowongan);
        $lowonganAktif = collect($lowongan)->where('status_loker', 'aktif')->count();
        $lowonganTutup = collect($lowongan)->where('status_loker', 'tutup')->count();
        $lowonganPerPageOptions = [10, 25, 50, 100];
        $lowonganPerPage = (int) request('per_page', 10);
        $lowonganPerPage = in_array($lowonganPerPage, $lowonganPerPageOptions, true) ? $lowonganPerPage : 10;

        $lastPage = max(1, (int) ceil($totalLowongan / $lowonganPerPage));
        $currentPage = min(max(1, (int) request('page', 1)), $lastPage);
        $items = array_slice($lowongan, ($currentPage - 1) * $lowonganPerPage, $lowonganPerPage);

        $lowongan = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $totalLowongan,
            $lowonganPerPage,
            $currentPage,
            [
                'path'  => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('admin.pages.lowongan.index', compact('lowongan', 'totalLowongan', 'lowonganAktif', 'lowonganTutup', 'lowonganPerPageOptions'));
    }

    public function showLowongan(Request $request, string $id)
    {
        $lowongan = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lowongan', [
                'lowongan_id' => 'eq.' . $id,
                'select'      => '*,jabatan(nama),jurusan(nama),tipe_pekerjaan(nama),sektor(nama),perusahaan(nama_perusahaan,email_perusahaan,kota,logo)',
            ])->json();

        if (empty($lowongan)) {
            abort(404, 'Lowongan tidak ditemukan');
        }

        $data = $lowongan[0];

        $lamaran = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'lowongan_id' => 'eq.' . $id,
                'select'      => 'lamaran_id,status_terakhir,created_at,pelamar:pelamar_id(pelamar_id,nama_lengkap,email,foto_profil,nim,bidang)',
                'order'       => 'created_at.desc',
            ])->json();

        $allLamaran = is_array($lamaran) ? $lamaran : [];
        $totalPelamar = count($allLamaran);
        $statusPelamar = [
            'applied'   => collect($allLamaran)->where('status_terakhir', 'applied')->count(),
            'reviewed'  => collect($allLamaran)->where('status_terakhir', 'reviewed')->count(),
            'interview' => collect($allLamaran)->where('status_terakhir', 'interview')->count(),
            'completed' => collect($allLamaran)->where('status_terakhir', 'completed')->count(),
        ];

        $pelamarPerPageOptions = [10, 25, 50, 100];
        $pelamarPerPage = (int) $request->query('per_page', 10);
        $pelamarPerPage = in_array($pelamarPerPage, $pelamarPerPageOptions, true) ? $pelamarPerPage : 10;

        $lastPage = max(1, (int) ceil($totalPelamar / $pelamarPerPage));
        $currentPage = min(max(1, (int) $request->query('page', 1)), $lastPage);
        $items = array_slice($allLamaran, ($currentPage - 1) * $pelamarPerPage, $pelamarPerPage);

        $lamaran = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $totalPelamar,
            $pelamarPerPage,
            $currentPage,
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('admin.pages.lowongan.show', compact('data', 'lamaran', 'totalPelamar', 'statusPelamar', 'pelamarPerPageOptions'));
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
            'id'               => 'required',
            'status'           => 'required|in:accepted,rejected,pending',
            'alasan_penolakan' => 'required_if:status,rejected|string|min:10|max:1000',
        ], [
            'alasan_penolakan.required_if' => 'Alasan penolakan wajib diisi dan akan dikirim ke email perusahaan.',
            'alasan_penolakan.min'         => 'Alasan penolakan minimal 10 karakter.',
            'alasan_penolakan.max'         => 'Alasan penolakan maksimal 1000 karakter.',
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

        if (in_array($request->status, ['accepted', 'rejected'], true)) {
            Mail::to($perusahaan[0]['email_perusahaan'])
                ->send(new CompanyVerified(
                    $perusahaan[0]['nama_perusahaan'],
                    $request->status,
                    $request->status === 'rejected' ? $request->alasan_penolakan : null,
                ));
        }

        $label = match($request->status) {  
            'accepted' => 'disetujui',
            'rejected' => 'ditolak',
            default    => 'diperbarui',
        };

        return redirect()->route('companies.show', $request->id)->with('success', "Perusahaan berhasil {$label} dan email notifikasi telah dikirim");
    }
}
