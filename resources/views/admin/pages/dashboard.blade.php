@extends('admin.layouts.app')
@section('content')
<div class="space-y-6">

    <!-- Greeting -->
    <div>
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Dashboard Admin</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola perusahaan, lowongan, dan pelamar di Dinus Career Center.</p>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-sm text-emerald-700">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    @php
        $total     = count($perusahaan);
        $pending   = collect($perusahaan)->where('status_verifikasi', 'pending')->count();
        $accepted  = collect($perusahaan)->where('status_verifikasi', 'accepted')->count();
        $rejected  = collect($perusahaan)->where('status_verifikasi', 'rejected')->count();
        $pendings  = collect($perusahaan)->where('status_verifikasi', 'pending')->values();
    @endphp

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="group bg-white rounded-2xl border border-gray-200 p-5 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $total }}</h3>
            <p class="text-xs text-gray-500 mt-1">Total Perusahaan</p>
        </div>
        <div class="group bg-white rounded-2xl border border-gray-200 p-5  transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition">
                    <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>  
                </div>
                @if($pending > 0)
                <span class="inline-flex items-center gap-1 text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded-full animate-pulse">
                    {{ $pending }} baru
                </span>
                @endif
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $pending }}</h3>
            <p class="text-xs text-gray-500 mt-1">Menunggu Verifikasi</p>
        </div>
        <div class="group bg-white rounded-2xl border border-gray-200 p-5 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $accepted }}</h3>
            <p class="text-xs text-gray-500 mt-1">Perusahaan Terverifikasi</p>
        </div>
        <div class="group bg-white rounded-2xl border border-gray-200 p-5 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center group-hover:bg-red-100 transition">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $rejected }}</h3>
            <p class="text-xs text-gray-500 mt-1">Perusahaan Ditolak</p>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Pendaftaran Perusahaan per Bulan -->
        <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h5 class="text-sm font-semibold text-gray-900">Pendaftaran Perusahaan</h5>
                    <p class="text-xs text-gray-400 mt-0.5">Jumlah perusahaan mendaftar per bulan</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                        <span class="text-xs text-gray-500">Terdaftar</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        <span class="text-xs text-gray-500">Terverifikasi</span>
                    </div>
                </div>
            </div>
            <div class="h-56">
                <canvas id="registrationChart"></canvas>
            </div>
        </div>

        <!-- Status Verifikasi -->
        <div class="bg-white rounded-2xl border border-gray-200 p-5">
            <div class="mb-6">
                <h5 class="text-sm font-semibold text-gray-900">Status Verifikasi</h5>
                <p class="text-xs text-gray-400 mt-0.5">Distribusi status perusahaan</p>
            </div>
            <div class="flex items-center justify-center h-44">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="grid grid-cols-3 gap-2 mt-5">
                <div class="flex flex-col items-center gap-1 px-3 py-2 rounded-lg bg-amber-50/60">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    <span class="text-xs font-semibold text-gray-900">{{ $pending }}</span>
                    <span class="text-xs text-gray-500">Pending</span>
                </div>
                <div class="flex flex-col items-center gap-1 px-3 py-2 rounded-lg bg-emerald-50/60">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="text-xs font-semibold text-gray-900">{{ $accepted }}</span>
                    <span class="text-xs text-gray-500">Diterima</span>
                </div>
                <div class="flex flex-col items-center gap-1 px-3 py-2 rounded-lg bg-red-50/60">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    <span class="text-xs font-semibold text-gray-900">{{ $rejected }}</span>
                    <span class="text-xs text-gray-500">Ditolak</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-12 gap-6">

        <!-- LEFT: Pending Approvals Table -->
        <div class="col-span-12 xl:col-span-8">
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                <div class="flex items-center justify-between p-5 border-b border-gray-100">
                    <div>
                        <h5 class="text-sm font-semibold text-gray-900">Perusahaan Menunggu Verifikasi</h5>
                        <p class="text-xs text-gray-400 mt-0.5">Setujui atau tolak pendaftaran perusahaan baru.</p>
                    </div>
                    <a href="{{ route('companies') }}" class="text-xs font-medium text-blue-600 hover:text-blue-700 transition">Lihat Semua →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50/80">
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-5">Perusahaan</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-5">Kota</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-5">Tanggal Daftar</th>
                                <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-5">Status</th>
                                <th class="text-right text-xs font-medium text-gray-500 uppercase tracking-wider py-3 px-5">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($perusahaan as $p)
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="py-3.5 px-5">
                                    <div class="flex items-center gap-3">
                                        @if(!empty($p['logo']))
                                            <img src="{{ $p['logo'] }}" class="w-9 h-9 rounded-lg object-cover border border-gray-200" />
                                        @else
                                            <div class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500">
                                                {{ strtoupper(substr($p['nama_perusahaan'] ?? 'N', 0, 2)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $p['nama_perusahaan'] ?? '-' }}</p>
                                            <p class="text-xs text-gray-400">{{ $p['email_perusahaan'] ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-5 text-xs text-gray-600">{{ $p['kota'] ?? '-' }}</td>
                                <td class="py-3.5 px-5 text-xs text-gray-500">{{ \Carbon\Carbon::parse($p['created_at'])->format('d M Y') }}</td>
                                <td class="py-3.5 px-5">
                                    @if($p['status_verifikasi'] === 'pending')
                                        <span class="inline-flex items-center gap-1 text-xs font-medium text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Pending
                                        </span>
                                    @elseif($p['status_verifikasi'] === 'accepted')
                                        <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Diterima
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-xs font-medium text-red-700 bg-red-50 px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        @if($p['status_verifikasi'] !== 'accepted')
                                        <form method="POST" action="{{ route('admin.verify.company') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $p['perusahaan_id'] }}">
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition" title="Setujui">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            </button>
                                        </form>
                                        @endif
                                        @if($p['status_verifikasi'] !== 'rejected')
                                        <form method="POST" action="{{ route('admin.verify.company') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $p['perusahaan_id'] }}">
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Tolak">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-5 py-12 text-center">
                                    <svg class="w-10 h-10 text-gray-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <p class="text-sm text-gray-400">Belum ada perusahaan yang mendaftar</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- RIGHT Column -->
        <div class="col-span-12 xl:col-span-4 flex flex-col gap-6">

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl border border-gray-200 p-5">
                <h5 class="text-sm font-semibold text-gray-900 mb-4">Aksi Cepat</h5>
                <div class="space-y-2">
                    <a href="{{ route('companies') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50/80 hover:bg-blue-50 transition group">
                        <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">Kelola Perusahaan</p>
                            <p class="text-xs text-gray-400">Verifikasi & lihat semua perusahaan</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-blue-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('lowongan.index') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50/80 hover:bg-emerald-50 transition group">
                        <div class="w-9 h-9 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">Daftar Lowongan</p>
                            <p class="text-xs text-gray-400">Pantau semua lowongan aktif</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-emerald-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('events') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50/80 hover:bg-purple-50 transition group">
                        <div class="w-9 h-9 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">Kelola Event</p>
                            <p class="text-xs text-gray-400">Buat & kelola event karier</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-purple-400 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Perusahaan Terbaru -->
            <div class="bg-white rounded-2xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-sm font-semibold text-gray-900">Perusahaan Terbaru</h5>
                    <span class="text-xs text-gray-400">5 terakhir</span>
                </div>
                <div class="space-y-3">
                    @forelse(collect($perusahaan)->take(5) as $p)
                    <div class="flex items-center gap-3">
                        @if(!empty($p['logo']))
                            <img src="{{ $p['logo'] }}" class="w-8 h-8 rounded-lg object-cover border border-gray-200" />
                        @else
                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-400">
                                {{ strtoupper(substr($p['nama_perusahaan'] ?? 'N', 0, 2)) }}
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $p['nama_perusahaan'] ?? '-' }}</p>
                            <p class="text-xs text-gray-400">{{ $p['kota'] ?? '-' }}</p>
                        </div>
                        @if($p['status_verifikasi'] === 'pending')
                            <span class="w-2 h-2 rounded-full bg-amber-400 flex-shrink-0"></span>
                        @elseif($p['status_verifikasi'] === 'accepted')
                            <span class="w-2 h-2 rounded-full bg-emerald-500 flex-shrink-0"></span>
                        @else
                            <span class="w-2 h-2 rounded-full bg-red-400 flex-shrink-0"></span>
                        @endif
                    </div>
                    @empty
                    <p class="text-xs text-gray-400 text-center py-4">Belum ada data</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Registration Bar Chart
    const regCtx = document.getElementById('registrationChart').getContext('2d');
    new Chart(regCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [
                {
                    label: 'Terdaftar',
                    data: [4, 6, 3, 8, 5, {{ $total > 0 ? $total : 7 }}],
                    backgroundColor: 'rgba(59,130,246,0.7)',
                    borderRadius: 6,
                    barPercentage: 0.5,
                },
                {
                    label: 'Terverifikasi',
                    data: [3, 4, 2, 6, 4, {{ $accepted > 0 ? $accepted : 5 }}],
                    backgroundColor: 'rgba(16,185,129,0.7)',
                    borderRadius: 6,
                    barPercentage: 0.5,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#9ca3af' } },
                y: { beginAtZero: true, grid: { color: '#f3f4f6' }, ticks: { font: { size: 11 }, color: '#9ca3af', stepSize: 2 } }
            }
        }
    });

    // Status Doughnut Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Diterima', 'Ditolak'],
            datasets: [{
                data: [{{ $pending }}, {{ $accepted }}, {{ $rejected }}],
                backgroundColor: ['#f59e0b', '#10b981', '#ef4444'],
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
                    padding: 10,
                    cornerRadius: 8,
                }
            }
        }
    });
});
</script>
@endsection
