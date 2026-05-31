@extends('admin.layouts.app')
@section('content')
<div class="space-y-8">

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('error') }}
    </div>
    @endif

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Kelola Perusahaan</h1>
            <p class="text-sm text-gray-500 mt-1">Verifikasi dan pantau semua perusahaan terdaftar di DCC.</p>
        </div>
    </div>

    @php
        $allPerusahaan   = $allPerusahaan ?? $perusahaan;
        $statusFilter    = $statusFilter ?? request('status', 'all');
        $totalPerusahaan = is_array($allPerusahaan) ? count($allPerusahaan) : 0;
        $pendingCount    = is_array($allPerusahaan) ? collect($allPerusahaan)->where('status_verifikasi', 'pending')->count() : 0;
        $acceptedCount   = is_array($allPerusahaan) ? collect($allPerusahaan)->where('status_verifikasi', 'accepted')->count() : 0;
        $rejectedCount   = is_array($allPerusahaan) ? collect($allPerusahaan)->where('status_verifikasi', 'rejected')->count() : 0;
        $filteredCount   = $filteredTotal ?? (is_array($perusahaan) ? count($perusahaan) : $perusahaan->total());
        $filterTabs = [
            'all'      => ['label' => 'Semua', 'count' => $totalPerusahaan],
            'pending'  => ['label' => 'Pending', 'count' => $pendingCount],
            'accepted' => ['label' => 'Terverifikasi', 'count' => $acceptedCount],
            'rejected' => ['label' => 'Ditolak', 'count' => $rejectedCount],
        ];
    @endphp

    <!-- Stats Section -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Perusahaan</p>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $totalPerusahaan }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-blue-50 rounded-2xl">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Menunggu Verifikasi</p>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $pendingCount }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-amber-50 rounded-2xl">
                    <svg class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Terverifikasi</p>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $acceptedCount }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 rounded-2xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="relative overflow-hidden bg-white rounded-3xl border border-gray-100 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Ditolak</p>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ $rejectedCount }}</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 bg-red-50 rounded-2xl">
                    <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Filters -->
    <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] p-4">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <h2 class="text-sm font-bold text-gray-900">Antrian Review Perusahaan</h2>
                <p class="text-xs text-gray-500 mt-1">Gunakan filter pending untuk memprioritaskan perusahaan yang perlu diverifikasi.</p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                @foreach($filterTabs as $key => $tab)
                <a href="{{ $key === 'all' ? route('companies') : route('companies', ['status' => $key]) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold border transition-all duration-200 {{ $statusFilter === $key ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-indigo-600 hover:border-indigo-100' }}">
                    {{ $tab['label'] }}
                    <span class="inline-flex items-center justify-center min-w-6 h-6 px-2 rounded-full {{ $statusFilter === $key ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-600' }}">
                        {{ $tab['count'] }}
                    </span>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Companies Table -->
    <div class="bg-white border border-gray-100 rounded-3xl shadow-[0_4px_20px_-4px_rgba(6,81,237,0.05)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Perusahaan</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Lokasi</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Contact Person</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Terdaftar</th>
                        <th scope="col" class="px-6 py-5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($perusahaan as $p)
                    <tr class="hover:bg-indigo-50/30 transition-colors group {{ ($p['status_verifikasi'] ?? '') === 'pending' ? 'bg-amber-50/30' : '' }}">
                        <!-- Perusahaan -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="shrink-0 h-12 w-12 rounded-2xl border border-gray-100 bg-white shadow-sm overflow-hidden group-hover:border-indigo-200 group-hover:shadow-indigo-100 transition-all duration-200">
                                    @if(!empty($p['logo']))
                                        <img src="{{ $p['logo'] }}" class="w-full h-full object-cover" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-indigo-50 text-indigo-600 font-bold text-sm">
                                            {{ strtoupper(substr($p['nama_perusahaan'] ?? 'N', 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $p['nama_perusahaan'] ?? '-' }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $p['email_perusahaan'] ?? '-' }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Lokasi -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span class="text-sm text-gray-700">{{ $p['kota'] ?? '-' }}</span>
                            </div>
                        </td>

                        <!-- Contact Person -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $p['nama_cp'] ?? '-' }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $p['jabatan'] ?? '-' }}</div>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            @if(($p['status_verifikasi'] ?? '') === 'pending')
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Pending
                            </span>
                            @elseif(($p['status_verifikasi'] ?? '') === 'accepted')
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Terverifikasi
                            </span>
                            @else
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-100 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                Ditolak
                            </span>
                            @endif
                        </td>

                        <!-- Tanggal Daftar -->
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($p['created_at'])->format('d M Y') }}</span>
                            </div>
                        </td>

                        <!-- Aksi -->
                        <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('companies.show', $p['perusahaan_id']) }}" class="p-2.5 text-gray-400 {{ ($p['status_verifikasi'] ?? '') === 'pending' ? 'hover:text-amber-600 hover:bg-amber-50' : 'hover:text-indigo-600 hover:bg-indigo-50' }} rounded-xl transition-all duration-200" title="{{ ($p['status_verifikasi'] ?? '') === 'pending' ? 'Review Perusahaan' : 'Lihat Detail' }}">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <!-- Empty State -->
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <p class="text-gray-900 font-semibold text-lg">Belum ada perusahaan</p>
                                <p class="text-gray-400 text-sm mt-1">Belum ada perusahaan yang mendaftar di platform.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($filteredCount > 0)
        @include('company.components.table-pagination', [
            'id' => 'companies',
            'paginator' => $perusahaan,
            'rowsPerPageOptions' => $perPageOptions ?? [10, 25, 50, 100],
            'label' => 'Companies table pagination',
        ])
        @endif
    </div>
</div>
@endsection
