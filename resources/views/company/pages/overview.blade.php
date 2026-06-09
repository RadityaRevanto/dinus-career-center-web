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
                <div class="flex items-center justify-between p-5 border-b border-gray-100">
                    <h5 class="text-lg font-bold text-gray-900">Lamaran Terbaru</h5>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" placeholder="Cari pelamar..."
                            class="pl-9 pr-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-gray-50/50 focus:bg-white focus:border-blue-300 focus:ring-2 focus:ring-blue-100 outline-none transition w-48">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
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
                                        'completed' => ['bg-emerald-50 text-emerald-700', 'bg-emerald-500', 'Completed'],
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
                                    <td colspan="4" class="py-8 text-center text-base text-gray-500">Belum ada lamaran masuk</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-sm text-gray-500">Menampilkan {{ count($lamaranTerbaru) }} dari {{ $countTotalPelamar }} pelamar</p>
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

    // Client-side search in "Lamaran Terbaru"
    const searchInput = document.querySelector('input[placeholder="Cari pelamar..."]');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            rows.forEach(row => {
                // Don't filter empty row state
                if (row.querySelector('td[colspan]')) return;
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }
});
</script>
@endpush