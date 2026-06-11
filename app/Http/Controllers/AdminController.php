<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyVerified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class AdminController extends Controller
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

        $perusahaanIds = collect($allPerusahaan)->pluck('perusahaan_id')->filter()->values()->all();
        $jumlahLowongan = [];

        if (! empty($perusahaanIds)) {
            $lowongan = Http::withHeaders($this->headers())
                ->get($this->baseUrl . '/rest/v1/lowongan', [
                    'select'        => 'perusahaan_id',
                    'perusahaan_id' => 'in.(' . implode(',', $perusahaanIds) . ')',
                ])->json();

            $jumlahLowongan = is_array($lowongan)
                ? collect($lowongan)->groupBy('perusahaan_id')->map->count()->all()
                : [];
        }

        $allPerusahaan = collect($allPerusahaan)->map(function ($item) use ($jumlahLowongan) {
            $item['jumlah_lowongan'] = $jumlahLowongan[$item['perusahaan_id'] ?? null] ?? 0;
            return $item;
        })->all();

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
        $lowonganTutup = collect($allLowongan)->where('status_loker', 'tidak')->count();
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
        $lowonganTutup = collect($lowongan)->where('status_loker', 'tidak')->count();
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

    public function events(Request $request)
    {
        $allEvents = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/events', [
                'select' => '*',
                'order'  => 'event_date.desc,start_time.desc',
            ])->json();

        $allEvents = is_array($allEvents) ? array_values(array_filter($allEvents, 'is_array')) : [];
        $totalEvents = count($allEvents);
        $activeEvents = collect($allEvents)->where('status', 'published')->count();
        $inactiveEvents = collect($allEvents)->where('status', '!=', 'published')->count();

        $eventPerPageOptions = [10, 25, 50, 100];
        $eventPerPage = (int) $request->query('per_page', 10);
        $eventPerPage = in_array($eventPerPage, $eventPerPageOptions, true) ? $eventPerPage : 10;

        $lastPage = max(1, (int) ceil($totalEvents / $eventPerPage));
        $currentPage = min(max(1, (int) $request->query('page', 1)), $lastPage);
        $items = array_slice($allEvents, ($currentPage - 1) * $eventPerPage, $eventPerPage);

        $events = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $totalEvents,
            $eventPerPage,
            $currentPage,
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('admin.pages.event.index', compact(
            'events',
            'totalEvents',
            'activeEvents',
            'inactiveEvents',
            'eventPerPageOptions'
        ));
    }

    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'event_date'        => 'required|date',
            'start_time'        => 'required|date_format:H:i',
            'end_time'          => 'nullable|date_format:H:i|after:start_time',
            'location_name'     => 'nullable|string|max:255',
            'address'           => 'nullable|string',
            'benefits'          => 'nullable|string',
            'speakers'          => 'nullable|array',
            'speakers.*.speaker_name' => 'nullable|string|max:255',
            'speakers.*.speaker_title' => 'nullable|string|max:255',
            'speakers.*.speaker_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category'          => 'nullable|string|max:100',
            'organizer'         => 'nullable|string|max:255',
            'max_participants'  => 'nullable|integer|min:0',
            'registration_link' => 'nullable|url|max:1000',
            'status'            => 'required|in:draft,published,closed,cancelled',
        ]);

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'banners/event-' . time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileBytes = file_get_contents($file->getRealPath());

            $uploadRes = Http::withHeaders([
                'apikey'        => $this->serviceRole,
                'Authorization' => 'Bearer ' . $this->serviceRole,
                'Content-Type'  => $file->getMimeType(),
                'x-upsert'      => 'true',
            ])->withBody($fileBytes, $file->getMimeType())
              ->post($this->baseUrl . '/storage/v1/object/event-images/' . $fileName);

            if ($uploadRes->failed()) {
                return back()
                    ->with('error', 'Gagal upload gambar event: ' . $uploadRes->body())
                    ->withInput();
            }

            $imageUrl = $this->baseUrl . '/storage/v1/object/public/event-images/' . $fileName;
        }

        $payload = [
            'title'             => $validated['title'],
            'slug'              => $validated['slug'] ?? null,
            'description'       => $validated['description'] ?? null,
            'image_url'         => $imageUrl,
            'event_date'        => $validated['event_date'],
            'start_time'        => $validated['start_time'],
            'end_time'          => $validated['end_time'] ?? null,
            'location_name'     => $validated['location_name'] ?? null,
            'address'           => $validated['address'] ?? null,
            'benefits'          => $validated['benefits'] ?? null,
            'category'          => $validated['category'] ?? null,
            'organizer'         => $validated['organizer'] ?? null,
            'max_participants'  => (int) ($validated['max_participants'] ?? 0),
            'registration_link' => $validated['registration_link'] ?? null,
            'status'            => $validated['status'],
        ];

        $res = Http::withHeaders(array_merge($this->headers(), [
                'Prefer' => 'return=representation',
            ]))
            ->post($this->baseUrl . '/rest/v1/events', $payload);

        if ($res->failed()) {
            return back()
                ->with('error', 'Gagal membuat event: ' . $res->body())
                ->withInput();
        }

        $createdEvent = $res->json();
        $eventId = $createdEvent[0]['id'] ?? null;

        if ($eventId && !empty($validated['speakers'])) {
            $speakerRows = [];

            foreach ($validated['speakers'] as $index => $speaker) {
                $speakerName = $speaker['speaker_name'] ?? null;
                $speakerTitle = $speaker['speaker_title'] ?? null;
                $speakerImageUrl = null;
                $speakerFile = $request->file("speakers.$index.speaker_image");

                if ($speakerFile) {
                    $fileName = 'speakers/speaker-' . time() . '-' . uniqid() . '.' . $speakerFile->getClientOriginalExtension();
                    $fileBytes = file_get_contents($speakerFile->getRealPath());

                    $uploadRes = Http::withHeaders([
                        'apikey'        => $this->serviceRole,
                        'Authorization' => 'Bearer ' . $this->serviceRole,
                        'Content-Type'  => $speakerFile->getMimeType(),
                        'x-upsert'      => 'true',
                    ])->withBody($fileBytes, $speakerFile->getMimeType())
                      ->post($this->baseUrl . '/storage/v1/object/event-images/' . $fileName);

                    if ($uploadRes->failed()) {
                        return redirect()->route('events')
                            ->with('error', 'Event dibuat, tetapi upload foto speaker gagal: ' . $uploadRes->body());
                    }

                    $speakerImageUrl = $this->baseUrl . '/storage/v1/object/public/event-images/' . $fileName;
                }

                if (empty(trim($speakerName ?? ''))) {
                    continue;
                }

                $speakerRows[] = [
                    'event_id' => $eventId,
                    'nama'     => $speakerName,
                    'jabatan'  => $speakerTitle,
                    'foto'     => $speakerImageUrl,
                    'urutan'   => count($speakerRows) + 1,
                ];
            }

            if (!empty($speakerRows)) {
                $speakerRes = Http::withHeaders($this->headers())
                    ->post($this->baseUrl . '/rest/v1/event_speakers', $speakerRows);

                if ($speakerRes->failed()) {
                    return redirect()->route('events')
                        ->with('error', 'Event dibuat, tetapi data speaker gagal disimpan: ' . $speakerRes->body());
                }
            }
        }

        return redirect()->route('events')->with('success', 'Event berhasil dibuat.');
    }

    public function editEvent(string $id)
    {
        $event = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/events', [
                'id'     => 'eq.' . $id,
                'select' => '*',
                'limit'  => 1,
            ])->json();

        if (empty($event) || !is_array($event)) {
            abort(404, 'Event tidak ditemukan');
        }

        $speakers = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/event_speakers', [
                'event_id' => 'eq.' . $id,
                'select'   => '*',
                'order'    => 'urutan.asc',
            ])->json();

        $speakers = is_array($speakers) ? array_values(array_filter($speakers, 'is_array')) : [];

        return view('admin.pages.event.edit', [
            'event' => $event[0],
            'speakers' => $speakers,
        ]);
    }

    public function updateEvent(Request $request, string $id)
    {
        $existing = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/events', [
                'id'     => 'eq.' . $id,
                'select' => '*',
                'limit'  => 1,
            ])->json();

        if (empty($existing) || !is_array($existing)) {
            abort(404, 'Event tidak ditemukan');
        }

        $event = $existing[0];

        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'event_date'        => 'required|date',
            'start_time'        => 'required|date_format:H:i',
            'end_time'          => 'nullable|date_format:H:i|after:start_time',
            'location_name'     => 'nullable|string|max:255',
            'address'           => 'nullable|string',
            'benefits'          => 'nullable|string',
            'speakers'          => 'nullable|array',
            'speakers.*.speaker_name' => 'nullable|string|max:255',
            'speakers.*.speaker_title' => 'nullable|string|max:255',
            'speakers.*.speaker_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'speakers.*.existing_speaker_image' => 'nullable|string|max:1000',
            'category'          => 'nullable|string|max:100',
            'organizer'         => 'nullable|string|max:255',
            'max_participants'  => 'nullable|integer|min:0',
            'registration_link' => 'nullable|url|max:1000',
            'status'            => 'required|in:draft,published,closed,cancelled',
        ]);

        $imageUrl = $event['image_url'] ?? null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'banners/event-' . time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $fileBytes = file_get_contents($file->getRealPath());

            $uploadRes = Http::withHeaders([
                'apikey'        => $this->serviceRole,
                'Authorization' => 'Bearer ' . $this->serviceRole,
                'Content-Type'  => $file->getMimeType(),
                'x-upsert'      => 'true',
            ])->withBody($fileBytes, $file->getMimeType())
              ->post($this->baseUrl . '/storage/v1/object/event-images/' . $fileName);

            if ($uploadRes->failed()) {
                return back()
                    ->with('error', 'Gagal upload gambar event: ' . $uploadRes->body())
                    ->withInput();
            }

            $imageUrl = $this->baseUrl . '/storage/v1/object/public/event-images/' . $fileName;
        }

        $payload = [
            'title'             => $validated['title'],
            'slug'              => $validated['slug'] ?? null,
            'description'       => $validated['description'] ?? null,
            'image_url'         => $imageUrl,
            'event_date'        => $validated['event_date'],
            'start_time'        => $validated['start_time'],
            'end_time'          => $validated['end_time'] ?? null,
            'location_name'     => $validated['location_name'] ?? null,
            'address'           => $validated['address'] ?? null,
            'benefits'          => $validated['benefits'] ?? null,
            'category'          => $validated['category'] ?? null,
            'organizer'         => $validated['organizer'] ?? null,
            'max_participants'  => (int) ($validated['max_participants'] ?? 0),
            'registration_link' => $validated['registration_link'] ?? null,
            'status'            => $validated['status'],
            'updated_at'        => now()->toIso8601String(),
        ];

        $res = Http::withHeaders($this->headers())
            ->patch($this->baseUrl . '/rest/v1/events?id=eq.' . $id, $payload);

        if ($res->failed()) {
            return back()
                ->with('error', 'Gagal update event: ' . $res->body())
                ->withInput();
        }

        Http::withHeaders($this->headers())
            ->delete($this->baseUrl . '/rest/v1/event_speakers?event_id=eq.' . $id);

        $speakerRows = [];

        foreach (($validated['speakers'] ?? []) as $index => $speaker) {
            $speakerName = $speaker['speaker_name'] ?? null;
            $speakerTitle = $speaker['speaker_title'] ?? null;
            $speakerImageUrl = $speaker['existing_speaker_image'] ?? null;
            $speakerFile = $request->file("speakers.$index.speaker_image");

            if ($speakerFile) {
                $fileName = 'speakers/speaker-' . time() . '-' . uniqid() . '.' . $speakerFile->getClientOriginalExtension();
                $fileBytes = file_get_contents($speakerFile->getRealPath());

                $uploadRes = Http::withHeaders([
                    'apikey'        => $this->serviceRole,
                    'Authorization' => 'Bearer ' . $this->serviceRole,
                    'Content-Type'  => $speakerFile->getMimeType(),
                    'x-upsert'      => 'true',
                ])->withBody($fileBytes, $speakerFile->getMimeType())
                  ->post($this->baseUrl . '/storage/v1/object/event-images/' . $fileName);

                if ($uploadRes->failed()) {
                    return redirect()->route('events')
                        ->with('error', 'Event diupdate, tetapi upload foto speaker gagal: ' . $uploadRes->body());
                }

                $speakerImageUrl = $this->baseUrl . '/storage/v1/object/public/event-images/' . $fileName;
            }

            if (empty(trim($speakerName ?? ''))) {
                continue;
            }

            $speakerRows[] = [
                'event_id' => $id,
                'nama'     => $speakerName,
                'jabatan'  => $speakerTitle,
                'foto'     => $speakerImageUrl,
                'urutan'   => count($speakerRows) + 1,
            ];
        }

        if (!empty($speakerRows)) {
            $speakerRes = Http::withHeaders($this->headers())
                ->post($this->baseUrl . '/rest/v1/event_speakers', $speakerRows);

            if ($speakerRes->failed()) {
                return redirect()->route('events')
                    ->with('error', 'Event diupdate, tetapi data speaker gagal disimpan: ' . $speakerRes->body());
            }
        }

        return redirect()->route('events')->with('success', 'Event berhasil diupdate.');
    }

    public function auditLog(Request $request)
    {
        $allLogs = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/audit_log', [
                'select' => '*',
                'order'  => 'created_at.desc',
                'limit'  => 200,
            ])->json();

        $allLogs = is_array($allLogs)
            ? array_values(array_filter($allLogs, 'is_array'))
            : [];

        $totalLog = count($allLogs);
        $todayLog = collect($allLogs)->filter(function ($log) {
            return ! empty($log['created_at'])
                && Carbon::parse($log['created_at'])->isToday();
        })->count();
        $activeModuleCount = collect($allLogs)->pluck('modul')->filter()->unique()->count();

        $auditLogPerPageOptions = [10, 25, 50, 100];
        $auditLogPerPage = (int) $request->query('per_page', 10);
        $auditLogPerPage = in_array($auditLogPerPage, $auditLogPerPageOptions, true) ? $auditLogPerPage : 10;

        $lastPage = max(1, (int) ceil($totalLog / $auditLogPerPage));
        $currentPage = min(max(1, (int) $request->query('page', 1)), $lastPage);
        $items = array_slice($allLogs, ($currentPage - 1) * $auditLogPerPage, $auditLogPerPage);

        $logs = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $totalLog,
            $auditLogPerPage,
            $currentPage,
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('admin.pages.audit-log.index', compact(
            'logs',
            'totalLog',
            'todayLog',
            'activeModuleCount',
            'auditLogPerPageOptions'
        ));
    }

    public function profile()
    {
        return view('admin.pages.profile');
    }

    public function password()
    {
        return view('admin.pages.password');
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
            return back()->with('error', 'Email admin tidak ditemukan di session. Silakan login ulang.');
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

    public function notificationsLatest()
    {
        $notifications = [];
        $unreadCount = 0;

        $pendingCompanies = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/perusahaan', [
                'status_verifikasi' => 'eq.pending',
                'select'            => '*',
                'order'             => 'created_at.desc',
                'limit'             => 10,
            ])->json();

        $pendingCompanies = is_array($pendingCompanies)
            ? array_values(array_filter($pendingCompanies, 'is_array'))
            : [];

        foreach ($pendingCompanies as $company) {
            $createdAt = Carbon::parse($company['created_at'] ?? now())->timezone('Asia/Jakarta');
            $updatedAt = ! empty($company['updated_at'])
                ? Carbon::parse($company['updated_at'])->timezone('Asia/Jakarta')
                : null;
            $isResubmission = $updatedAt && $updatedAt->greaterThan($createdAt->copy()->addMinutes(1));
            $notificationTime = $isResubmission ? $updatedAt : $createdAt;
            $isNew = $notificationTime->isAfter(Carbon::now('Asia/Jakarta')->subDays(7));

            if ($isNew) {
                $unreadCount++;
            }

            $notifications[] = [
                'id'         => ($isResubmission ? 'company-resubmit-' : 'company-') . ($company['perusahaan_id'] ?? uniqid()),
                'type'       => 'company',
                'judul'      => $isResubmission ? 'Perusahaan Mengajukan Review Ulang' : 'Perusahaan Menunggu Verifikasi',
                'pesan'      => $isResubmission
                    ? ($company['nama_perusahaan'] ?? 'Perusahaan') . ' sudah memperbarui profil dan mengajukan review ulang.'
                    : ($company['nama_perusahaan'] ?? 'Perusahaan baru') . ' perlu direview oleh admin.',
                'meta'       => $company['kota'] ?? $company['email_perusahaan'] ?? 'Perusahaan',
                'waktu'      => $notificationTime->diffForHumans(),
                'created_at' => $notificationTime->toIso8601String(),
                'url'        => ! empty($company['perusahaan_id']) ? route('companies.show', $company['perusahaan_id']) : route('companies', ['status' => 'pending']),
                'is_new'     => $isNew,
            ];
        }

        $newJobs = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lowongan', [
                'select' => 'lowongan_id,judul,status_loker,created_at,perusahaan(nama_perusahaan)',
                'order'  => 'created_at.desc',
                'limit'  => 10,
            ])->json();

        $newJobs = is_array($newJobs)
            ? array_values(array_filter($newJobs, 'is_array'))
            : [];

        foreach ($newJobs as $job) {
            $createdAt = Carbon::parse($job['created_at'] ?? now())->timezone('Asia/Jakarta');
            $isNew = $createdAt->isAfter(Carbon::now('Asia/Jakarta')->subDays(7));
            $companyName = $job['perusahaan']['nama_perusahaan'] ?? 'Perusahaan';
            $jobTitle = $job['judul'] ?? 'Lowongan';

            if ($isNew) {
                $unreadCount++;
            }

            $notifications[] = [
                'id'         => 'job-' . ($job['lowongan_id'] ?? uniqid()),
                'type'       => 'job',
                'judul'      => 'Lowongan Baru Dipublikasikan',
                'pesan'      => "{$companyName} membuat lowongan {$jobTitle}.",
                'meta'       => ucfirst($job['status_loker'] ?? 'lowongan'),
                'waktu'      => $createdAt->diffForHumans(),
                'created_at' => $createdAt->toIso8601String(),
                'url'        => ! empty($job['lowongan_id']) ? route('lowongan.show', $job['lowongan_id']) : route('lowongan.index'),
                'is_new'     => $isNew,
            ];
        }

        $applications = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/rest/v1/lamaran', [
                'status_terakhir' => 'eq.applied',
                'select'          => 'lamaran_id,status_terakhir,created_at,lowongan_id,pelamar:pelamar_id(nama_lengkap),lowongan:lowongan_id(judul)',
                'order'           => 'created_at.desc',
                'limit'           => 10,
            ])->json();

        $applications = is_array($applications)
            ? array_values(array_filter($applications, 'is_array'))
            : [];

        foreach ($applications as $application) {
            $createdAt = Carbon::parse($application['created_at'] ?? now())->timezone('Asia/Jakarta');
            $isNew = $createdAt->isAfter(Carbon::now('Asia/Jakarta')->subDays(7));
            $pelamarName = $application['pelamar']['nama_lengkap'] ?? 'Pelamar';
            $jobTitle = $application['lowongan']['judul'] ?? 'lowongan';

            if ($isNew) {
                $unreadCount++;
            }

            $notifications[] = [
                'id'         => 'application-' . ($application['lamaran_id'] ?? uniqid()),
                'type'       => 'application',
                'judul'      => 'Lamaran Baru Masuk',
                'pesan'      => "{$pelamarName} melamar untuk posisi {$jobTitle}.",
                'meta'       => $jobTitle,
                'waktu'      => $createdAt->diffForHumans(),
                'created_at' => $createdAt->toIso8601String(),
                'url'        => ! empty($application['lowongan_id']) ? route('lowongan.show', $application['lowongan_id']) : route('lowongan.index'),
                'is_new'     => $isNew,
            ];
        }

        usort($notifications, fn ($a, $b) => strcmp($b['created_at'], $a['created_at']));

        return response()->json([
            'notifications' => array_slice($notifications, 0, 15),
            'unread_count'  => $unreadCount,
        ]);
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
