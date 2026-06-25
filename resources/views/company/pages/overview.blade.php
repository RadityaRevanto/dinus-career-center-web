@extends('company.layouts.app')
@section('content')
<div class="space-y-6">

    <!-- Greeting -->
    <div>
        <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">Selamat Datang, {{ session('full_name') ?? 'Perusahaan' }}! 👋</h2>
        <p class="text-base text-gray-500 mt-1">Berikut ringkasan aktivitas rekrutmen perusahaan Anda.</p>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <!-- Lowongan Aktif -->
        <div class="group relative bg-white rounded-2xl border border-gray-200 p-5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-extrabold text-gray-900">{{ $countLowonganAktif }}</h3>
            <p class="text-sm font-medium text-gray-500 mt-1">Lowongan Aktif</p>
        </div>
        <!-- Total Pelamar -->
        <div class="group relative bg-white rounded-2xl border border-gray-200 p-5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition">
                    <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-extrabold text-gray-900">{{ $countTotalPelamar }}</h3>
            <p class="text-sm font-medium text-gray-500 mt-1">Total Pelamar</p>
        </div>
        <!-- Sedang Diproses -->
        <div class="group relative bg-white rounded-2xl border border-gray-200 p-5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center group-hover:bg-indigo-100 transition">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-extrabold text-gray-900">{{ $countDiproses }}</h3>
            <p class="text-sm font-medium text-gray-500 mt-1">Sedang Diproses</p>
        </div>
        <!-- Completed -->
        <div class="group relative bg-white rounded-2xl border border-gray-200 p-5 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-extrabold text-gray-900">{{ $countDiterima }}</h3>
            <p class="text-sm font-medium text-gray-500 mt-1">Selesai</p>
        </div>
    </div>

    <!-- Statistics Charts -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Tren Pelamar (Line Chart) -->
        <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h5 class="text-lg font-bold text-gray-900">Tren Pelamar</h5>
                    <p class="text-sm text-gray-500 mt-0.5">Jumlah pelamar masuk 6 bulan terakhir</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                        <span class="text-sm text-gray-500">Pelamar Masuk</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        <span class="text-sm text-gray-500">Selesai / Completed</span>
                    </div>
                </div>
            </div>
            <div class="h-56">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        <!-- Status Pelamar (Doughnut Chart) -->
        <div class="bg-white rounded-2xl border border-gray-200 p-5">
            <div class="mb-6">
                <h5 class="text-lg font-bold text-gray-900">Status Pelamar</h5>
                <p class="text-sm text-gray-500 mt-0.5">Distribusi status seluruh pelamar</p>
            </div>
            <div class="flex items-center justify-center h-44">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="grid grid-cols-2 gap-2 mt-5">
                <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-amber-50/60">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    <span class="text-sm text-gray-600">Review</span>
                    <span class="text-sm font-semibold text-gray-900 ml-auto">{{ $chartStatusData['review'] }}</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-blue-50/60">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    <span class="text-sm text-gray-600">Interview</span>
                    <span class="text-sm font-semibold text-gray-900 ml-auto">{{ $chartStatusData['interview'] }}</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-emerald-50/60">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="text-sm text-gray-600">Selesai / Completed</span>
                    <span class="text-sm font-semibold text-gray-900 ml-auto">{{ $chartStatusData['diterima'] }}</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-red-50/60">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    <span class="text-sm text-gray-600">Ditolak</span>
                    <span class="text-sm font-semibold text-gray-900 ml-auto">{{ $chartStatusData['ditolak'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-12 gap-6">

        <!-- LEFT: Lamaran Terbaru -->
        <div class="col-span-12 xl:col-span-8">
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                <div class="flex flex-col gap-4 p-5 border-b border-gray-100 sm:flex-row sm:items-end sm:justify-between">
                    <h5 class="text-lg font-bold text-gray-900 shrink-0">Lamaran Terbaru</h5>
                    <div class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-2 w-full sm:w-auto sm:justify-end">
                        <div class="relative flex-1 sm:flex-none sm:w-64">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" id="overview-lamaran-search" placeholder="Cari nama atau posisi..."
                                class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50/50 focus:bg-white focus:border-blue-300 focus:ring-2 focus:ring-blue-100 outline-none transition">
                        </div>
                        <span id="overview-lamaran-search-count" class="hidden text-xs text-gray-500 shrink-0"></span>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table id="overview-lamaran-table" class="w-full">
                        <thead>
                            <tr class="bg-gray-50/80">
                                <th class="text-left text-sm font-semibold text-gray-500 uppercase tracking-wider py-3.5 px-5">Pelamar</th>
                                <th class="text-left text-sm font-semibold text-gray-500 uppercase tracking-wider py-3.5 px-5">Posisi</th>
                                <th class="text-left text-sm font-semibold text-gray-500 uppercase tracking-wider py-3.5 px-5">Tanggal</th>
                                <th class="text-left text-sm font-semibold text-gray-500 uppercase tracking-wider py-3.5 px-5">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($lamaranTerbaru as $item)
                                @php
                                    $pelamar = $item['pelamar'];
                                    $avatar = $pelamar['foto_profil'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($pelamar['nama_lengkap']) . '&background=e0e7ff&color=4f46e5&bold=true&size=128';
                                    
                                    $statusConfig = [
                                        'applied'   => ['bg-amber-50 text-amber-700', 'bg-amber-500', 'Review'],
                                        'reviewed'  => ['bg-sky-50 text-sky-700', 'bg-sky-500', 'Reviewed'],
                                        'interview' => ['bg-blue-50 text-blue-700', 'bg-blue-500', 'Interview'],
                                        'accepted' => ['bg-emerald-50 text-emerald-700', 'bg-emerald-500', 'Diterima'],
                                        'rejected' => ['bg-rose-50 text-rose-700', 'bg-rose-500', 'Ditolak'],
                                    ];
                                    $cfg = $statusConfig[$item['status_terakhir']] ?? $statusConfig['applied'];
                                @endphp
                                <tr class="hover:bg-blue-50/30 transition">
                                    <td class="py-4 px-5">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $avatar }}" class="w-9 h-9 rounded-full object-cover" />
                                            <div>
                                                <p class="text-base font-semibold text-gray-900">{{ $pelamar['nama_lengkap'] }}</p>
                                                <p class="text-sm text-gray-500">{{ $pelamar['email'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-sm text-gray-600">{{ $item['lowongan']['judul'] ?? 'N/A' }}</td>
                                    <td class="py-4 px-5 text-sm text-gray-500">{{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('d M Y') }}</td>
                                    <td class="py-4 px-5">
                                        <span class="inline-flex items-center gap-1.5 text-sm font-semibold {{ $cfg[0] }} px-3 py-1 rounded-full">
                                            <span class="w-2 h-2 rounded-full {{ $cfg[1] }}"></span>{{ $cfg[2] }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-base text-gray-500">
                                        Belum ada lamaran masuk
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($lamaranTerbaru->total() > 0)
                @include('company.components.table-pagination', [
                    'id' => 'overview-lamaran',
                    'paginator' => $lamaranTerbaru,
                    'rowsPerPageOptions' => $lamaranPerPageOptions ?? [5, 10, 25, 50],
                    'label' => 'Lamaran terbaru pagination',
                ])
                @endif
                <div class="px-5 py-4 border-t border-gray-100 flex justify-end">
                    <a href="{{ route('applicants') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition">Lihat Semua →</a>
                </div>
            </div>
        </div>

        <!-- RIGHT Column -->
        <div class="col-span-12 xl:col-span-4 flex flex-col gap-6">

            <!-- Jadwal Interview -->
            <div class="bg-white rounded-2xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-lg font-bold text-gray-900">Jadwal Interview</h5>
                    <a href="{{ route('interviews.calendar') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition">Lihat Kalender →</a>
                </div>
                <div class="space-y-4">
                    @forelse(collect($interviews)->groupBy('tanggal') as $tanggal => $groupedInterviews)
                        <div class="mb-4 last:mb-0">
                            <h6 class="text-sm font-bold text-gray-700 mb-3 pb-1 border-b border-gray-100">{{ $tanggal }}</h6>
                            <div class="space-y-3">
                                @foreach($groupedInterviews as $interview)
                                    <div class="relative pl-4 border-l-2 border-blue-500 py-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <h6 class="text-base font-bold text-gray-900">{{ $interview['posisi'] }}</h6>
                                            <span class="text-sm text-gray-500 font-medium">{{ $interview['jam'] }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-0.5">{{ $interview['nama_pelamar'] }}</p>
                                        @if(!empty($interview['link_zoom']) && $interview['link_zoom'] !== '#')
                                            <a href="{{ $interview['link_zoom'] }}" target="_blank" class="inline-flex items-center gap-1.5 mt-1 text-xs font-semibold text-blue-600 hover:underline">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                                Gabung Meeting
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-sm text-gray-500">Tidak ada jadwal interview dalam waktu dekat</div>
                    @endforelse
                </div>
            </div>

            <!-- Lowongan Aktif -->
            <div class="bg-white rounded-2xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-lg font-bold text-gray-900">Lowongan Aktif</h5>
                    <a href="{{ route('jobs') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition">Kelola →</a>
                </div>
                <div class="space-y-3">
                    @forelse($activeJobs as $job)
                        <a href="{{ route('jobs.show', $job['lowongan_id']) }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50/80 hover:bg-gray-100/80 transition group">
                            <div class="w-10 h-10 rounded-lg {{ $job['bg'] }} flex items-center justify-center shrink-0">
                                {!! $job['icon'] !!}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-base font-semibold text-gray-900 truncate group-hover:text-blue-600 transition">{{ $job['judul'] }}</p>
                                <p class="text-sm text-gray-500">{{ $job['pelamar_count'] }} pelamar • Ditutup {{ $job['deadline'] }}</p>
                            </div>
                            <span class="shrink-0 w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        </a>
                    @empty
                        <div class="text-center py-6 text-sm text-gray-500">Belum ada lowongan aktif</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="application/json" id="overview-lamaran-data">{!! json_encode($allLamaranTerbaru ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) !!}</script>
<script type="application/json" id="overview-chart-data">
{
    "labels": @json($chartLabels),
    "pelamar": @json($chartDataPelamar),
    "diterima": @json($chartDataDiterima),
    "status": [
        @json($chartStatusData['review']),
        @json($chartStatusData['interview']),
        @json($chartStatusData['diterima']),
        @json($chartStatusData['ditolak'])
    ]
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const chartData = JSON.parse(document.getElementById('overview-chart-data')?.textContent || '{}');

    // Tren Pelamar - Line Chart
    const trendCanvas = document.getElementById('trendChart');
    if (trendCanvas) {
        const trendCtx = trendCanvas.getContext('2d');
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: chartData.labels || [],
                datasets: [
                    {
                        label: 'Pelamar Masuk',
                        data: chartData.pelamar || [],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.08)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#3b82f6',
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                    },
                    {
                        label: 'Selesai',
                        data: chartData.diterima || [],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16,185,129,0.06)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11, family: 'Montserrat' }, color: '#9ca3af' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6' },
                        ticks: { font: { size: 11, family: 'Montserrat' }, color: '#9ca3af', stepSize: 10 }
                    }
                },
                interaction: { intersect: false, mode: 'index' },
            }
        });
    }

    // Status Pelamar - Doughnut Chart
    const statusCanvas = document.getElementById('statusChart');
    if (statusCanvas) {
        const statusCtx = statusCanvas.getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Review', 'Interview', 'Selesai / Completed', 'Ditolak'],
                datasets: [{
                    data: chartData.status || [],
                    backgroundColor: ['#f59e0b', '#3b82f6', '#10b981', '#ef4444'],
                    borderWidth: 0,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: { family: 'Montserrat', size: 12 },
                        bodyFont: { family: 'Montserrat', size: 11 },
                        padding: 10,
                        cornerRadius: 8,
                    }
                }
            }
        });
    }

    // Lamaran Terbaru — client-side search
    const allLamaran = JSON.parse(document.getElementById('overview-lamaran-data')?.textContent || '[]');
    const lamaranTbody = document.querySelector('#overview-lamaran-table tbody');
    const lamaranSearchInput = document.getElementById('overview-lamaran-search');
    const lamaranSearchCount = document.getElementById('overview-lamaran-search-count');
    const lamaranPaginationNav = document.querySelector('nav[aria-label="Lamaran terbaru pagination"]');
    const lamaranRowsPerPageSelect = document.getElementById('rows-per-page-overview-lamaran');
    const lamaranCurrentPageInput = document.getElementById('current-page-overview-lamaran');
    const lamaranRowsInfoSpan = lamaranPaginationNav?.querySelector(':scope > div:first-child > span:last-child');
    const lamaranTotalPagesSpan = lamaranPaginationNav?.querySelector(':scope > div:last-child > span.whitespace-nowrap');
    const initialLamaranTbodyHtml = lamaranTbody ? lamaranTbody.innerHTML : '';
    const initialLamaranRowsInfo = lamaranRowsInfoSpan?.textContent ?? '';
    const initialLamaranCurrentPage = lamaranCurrentPageInput?.value ?? '1';
    const initialLamaranTotalPages = lamaranTotalPagesSpan?.textContent ?? '';
    let lamaranClientPage = 1;
    let lamaranClientModeActive = false;

    const lamaranStatusConfig = {
        applied: ['bg-amber-50 text-amber-700', 'bg-amber-500', 'Review'],
        reviewed: ['bg-sky-50 text-sky-700', 'bg-sky-500', 'Reviewed'],
        interview: ['bg-blue-50 text-blue-700', 'bg-blue-500', 'Interview'],
        accepted: ['bg-emerald-50 text-emerald-700', 'bg-emerald-500', 'Diterima'],
        rejected: ['bg-rose-50 text-rose-700', 'bg-rose-500', 'Ditolak'],
    };

    function escapeHtml(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function formatLamaranDate(value) {
        if (!value) return '-';
        const date = new Date(value);
        if (Number.isNaN(date.getTime())) return '-';
        return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
    }

    function lamaranAvatarUrl(pelamar) {
        if (pelamar?.foto_profil) return pelamar.foto_profil;
        const name = encodeURIComponent(pelamar?.nama_lengkap ?? 'User');
        return `https://ui-avatars.com/api/?name=${name}&background=e0e7ff&color=4f46e5&bold=true&size=128`;
    }

    function renderLamaranRow(item) {
        const pelamar = item.pelamar ?? {};
        const status = item.status_terakhir ?? 'applied';
        const cfg = lamaranStatusConfig[status] ?? lamaranStatusConfig.applied;
        const avatar = lamaranAvatarUrl(pelamar);
        const nama = pelamar.nama_lengkap ?? '-';
        const email = pelamar.email ?? '-';
        const posisi = item.lowongan?.judul ?? 'N/A';

        return `
            <tr class="hover:bg-blue-50/30 transition">
                <td class="py-4 px-5">
                    <div class="flex items-center gap-3">
                        <img src="${escapeHtml(avatar)}" class="w-9 h-9 rounded-full object-cover" alt="">
                        <div>
                            <p class="text-base font-semibold text-gray-900">${escapeHtml(nama)}</p>
                            <p class="text-sm text-gray-500">${escapeHtml(email)}</p>
                        </div>
                    </div>
                </td>
                <td class="py-4 px-5 text-sm text-gray-600">${escapeHtml(posisi)}</td>
                <td class="py-4 px-5 text-sm text-gray-500">${escapeHtml(formatLamaranDate(item.created_at))}</td>
                <td class="py-4 px-5">
                    <span class="inline-flex items-center gap-1.5 text-sm font-semibold ${cfg[0]} px-3 py-1 rounded-full">
                        <span class="w-2 h-2 rounded-full ${cfg[1]}"></span>${escapeHtml(cfg[2])}
                    </span>
                </td>
            </tr>
        `;
    }

    function renderLamaranEmptyFiltered() {
        return `
            <tr>
                <td colspan="4" class="py-8 text-center text-base text-gray-500">
                    Tidak ada lamaran yang cocok dengan pencarian.
                </td>
            </tr>
        `;
    }

    function isLamaranClientMode() {
        return lamaranSearchInput?.value.trim() !== '';
    }

    function getLamaranClientPerPage() {
        const value = parseInt(lamaranRowsPerPageSelect?.value || '5', 10);
        return Number.isNaN(value) ? 5 : value;
    }

    function getFilteredLamaran() {
        const query = lamaranSearchInput?.value.toLowerCase().trim() ?? '';

        return allLamaran.filter(function (item) {
            const nama = (item.pelamar?.nama_lengkap ?? '').toLowerCase();
            const email = (item.pelamar?.email ?? '').toLowerCase();
            const posisi = (item.lowongan?.judul ?? '').toLowerCase();

            return !query || nama.includes(query) || email.includes(query) || posisi.includes(query);
        });
    }

    function restoreLamaranServerPaginationUI() {
        if (lamaranRowsInfoSpan) lamaranRowsInfoSpan.textContent = initialLamaranRowsInfo;
        if (lamaranCurrentPageInput) lamaranCurrentPageInput.value = initialLamaranCurrentPage;
        if (lamaranTotalPagesSpan) lamaranTotalPagesSpan.textContent = initialLamaranTotalPages;

        lamaranPaginationNav?.querySelectorAll('a').forEach(function (link) {
            link.style.pointerEvents = '';
            link.style.opacity = '';
        });
    }

    function updateLamaranClientPaginationUI(total, page, perPage) {
        if (!lamaranPaginationNav) return;

        const totalPages = Math.max(1, Math.ceil(total / perPage) || 1);
        const safePage = Math.min(Math.max(page, 1), totalPages);
        const firstRow = total > 0 ? (safePage - 1) * perPage + 1 : 0;
        const lastRow = Math.min(safePage * perPage, total);

        if (lamaranRowsInfoSpan) {
            lamaranRowsInfoSpan.textContent = `${firstRow}–${lastRow} of ${total} rows`;
        }
        if (lamaranCurrentPageInput) {
            lamaranCurrentPageInput.value = safePage;
        }
        if (lamaranTotalPagesSpan) {
            lamaranTotalPagesSpan.textContent = `of ${totalPages}`;
        }

        lamaranPaginationNav.querySelectorAll('button, a').forEach(function (control) {
            const label = control.getAttribute('aria-label') || '';
            let disabled = false;

            if (label === 'First page' || label === 'Previous page') {
                disabled = safePage <= 1;
            }
            if (label === 'Next page' || label === 'Last page') {
                disabled = safePage >= totalPages;
            }

            if (control.tagName === 'BUTTON') {
                control.disabled = disabled;
            } else if (control.tagName === 'A') {
                control.style.pointerEvents = disabled ? 'none' : '';
                control.style.opacity = disabled ? '0.45' : '';
            }
        });

        lamaranClientPage = safePage;
    }

    function renderLamaranTable(resetPage) {
        if (!lamaranTbody || !lamaranSearchInput) return;

        if (resetPage) lamaranClientPage = 1;

        if (!isLamaranClientMode()) {
            lamaranClientModeActive = false;
            lamaranTbody.innerHTML = initialLamaranTbodyHtml;
            lamaranPaginationNav?.classList.remove('hidden');
            restoreLamaranServerPaginationUI();
            lamaranSearchCount?.classList.add('hidden');
            return;
        }

        lamaranClientModeActive = true;
        const filtered = getFilteredLamaran();
        const perPage = getLamaranClientPerPage();
        const totalPages = Math.max(1, Math.ceil(filtered.length / perPage) || 1);

        if (lamaranClientPage > totalPages) lamaranClientPage = totalPages;
        if (lamaranClientPage < 1) lamaranClientPage = 1;

        const start = (lamaranClientPage - 1) * perPage;
        const pageItems = filtered.slice(start, start + perPage);

        lamaranTbody.innerHTML = pageItems.length
            ? pageItems.map(renderLamaranRow).join('')
            : renderLamaranEmptyFiltered();

        lamaranPaginationNav?.classList.remove('hidden');
        updateLamaranClientPaginationUI(filtered.length, lamaranClientPage, perPage);

        if (lamaranSearchCount) {
            lamaranSearchCount.textContent = `${filtered.length} hasil`;
            lamaranSearchCount.classList.remove('hidden');
        }
    }

    if (lamaranSearchInput) {
        let lamaranDebounceTimer;
        lamaranSearchInput.addEventListener('input', function () {
            clearTimeout(lamaranDebounceTimer);
            lamaranDebounceTimer = setTimeout(function () {
                renderLamaranTable(true);
            }, 200);
        });

        lamaranRowsPerPageSelect?.form?.addEventListener('submit', function (e) {
            if (lamaranClientModeActive) e.preventDefault();
        });

        lamaranRowsPerPageSelect?.addEventListener('change', function () {
            if (!lamaranClientModeActive) return;
            renderLamaranTable(true);
        });

        lamaranPaginationNav?.addEventListener('click', function (e) {
            if (!lamaranClientModeActive) return;

            const control = e.target.closest('a, button');
            if (!control || control.disabled) return;

            const label = control.getAttribute('aria-label');
            if (!label) return;

            e.preventDefault();

            const filtered = getFilteredLamaran();
            const perPage = getLamaranClientPerPage();
            const totalPages = Math.max(1, Math.ceil(filtered.length / perPage));

            if (label === 'First page') lamaranClientPage = 1;
            else if (label === 'Previous page') lamaranClientPage = Math.max(1, lamaranClientPage - 1);
            else if (label === 'Next page') lamaranClientPage = Math.min(totalPages, lamaranClientPage + 1);
            else if (label === 'Last page') lamaranClientPage = totalPages;
            else return;

            renderLamaranTable(false);
        });
    }
});
</script>
@endpush