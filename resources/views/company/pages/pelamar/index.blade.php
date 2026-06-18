@extends('company.layouts.app')

@section('content')
<div class=" space-y-8">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Manajemen Pelamar</h1>
            <p class="text-sm text-gray-500 mt-2">Kelola semua kandidat yang melamar ke berbagai posisi di perusahaan Anda.</p>
        </div>
        <!-- <div class="flex items-center gap-3">
          
        </div> -->
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat 1 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100  hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pelamar</p>
                    <div class="flex items-baseline gap-2 mt-1">
                        <p class="text-2xl font-extrabold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Stat 2 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100  hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Menunggu Review</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">{{ $stats['applied'] }}</p>
                </div>
            </div>
        </div>
        <!-- Stat 3 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100  hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-sky-50 text-sky-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Tahap Wawancara</p>
                    <p class="text-2xl font-extrabold text-gray-900 mt-1">{{ $stats['interview'] }}</p>
                </div>
            </div>
        </div>
        <!-- Stat 4 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Diterima</p>
                    <div class="flex items-baseline gap-2 mt-1">
                        <p class="text-2xl font-extrabold text-gray-900">{{ $stats['accepted'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden">
        
        <!-- Toolbar (Search & Filters) -->
        <div class="p-6 sm:px-8 border-b border-gray-100 flex flex-col sm:flex-row gap-4 justify-between items-center bg-gray-50/30">
            <!-- Search -->
            <div class="relative w-full sm:max-w-md">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="block w-full pl-11 pr-4 py-2.5 border border-gray-200 bg-white hover:bg-gray-50 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 shadow-sm" placeholder="Cari nama pelamar atau email...">
            </div>

            <!-- Filters -->
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                <div class="relative w-full sm:w-40">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    </div>
                    <select class="block w-full pl-9 pr-8 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 appearance-none shadow-sm cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="pending">Applied</option>
                        <option value="review">Reviewed</option>
                        <option value="interview">Interview</option>
                        <option value="hired">Completed</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
                <a href="{{ route('applicants.export') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Ekspor Data
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80">
                    <tr>
                        <th scope="col" class="px-6 sm:px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Profil Pelamar
                        </th>
                        <th scope="col" class="px-6 sm:px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Melamar Posisi
                        </th>
                        <th scope="col" class="px-6 sm:px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Dokumen
                        </th>
                        <th scope="col" class="px-6 sm:px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 sm:px-8 py-5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($lamaran as $l)
                    @php
                        $pelamar = $l['pelamar'];
                        $berkas  = $l['berkas'];
                        $foto    = $pelamar['foto_profil'] 
                            ?? 'https://ui-avatars.com/api/?name=' . urlencode($pelamar['nama_lengkap']) . '&background=e0e7ff&color=4f46e5&bold=true';
                    @endphp
                    <tr class="hover:bg-blue-50/30 transition-colors group">

                        {{-- PROFIL PELAMAR --}}
                        <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <img class="h-11 w-11 rounded-full object-cover border border-gray-200 shadow-sm"
                                    src="{{ $foto }}" alt="{{ $pelamar['nama_lengkap'] }}">
                                <div>
                                    <div class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                        {{ $pelamar['nama_lengkap'] ?? '-' }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $pelamar['email'] ?? '-' }}</div>
                                    <!-- @if($pelamar['nim'])
                                    <div class="text-xs text-gray-400">NIM: {{ $pelamar['nim'] }}</div>
                                    @endif -->
                                </div>
                            </div>
                        </td>

                        {{-- MELAMAR POSISI --}}
                        <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">{{ $l['lowongan']['judul'] ?? '-' }}</div>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ \Carbon\Carbon::parse($l['created_at'])->diffForHumans() }}
                            </div>
                        </td>

                        {{-- DOKUMEN --}}
                        <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                            <div class="flex flex-col gap-1">
                                @if(!empty($berkas['cv']))
                                <a href="{{ route('applicants.berkas', ['id' => $l['lamaran_id'], 'tipe' => 'cv']) }}" target="_blank"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg text-xs font-semibold transition-colors w-fit border border-gray-200 hover:border-blue-200">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    CV
                                </a>
                                @endif
                                @if(empty($berkas['cv']))
                                <span class="text-xs text-gray-400">Tidak ada dokumen</span>
                                @endif
                            </div>
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                            @php
                                $statusConfig = [
                                    'applied'   => ['bg-amber-50 text-amber-700 border-amber-100', 'bg-amber-500', 'Applied'],
                                    'reviewed'  => ['bg-sky-50 text-sky-700 border-sky-100', 'bg-sky-500', 'Reviewed'],
                                    'interview' => ['bg-blue-50 text-blue-700 border-blue-100', 'bg-blue-500', 'Interview'],
                                    'accepted'  => ['bg-emerald-50 text-emerald-700 border-emerald-100', 'bg-emerald-500', 'Diterima'],
                                    'rejected'  => ['bg-rose-50 text-rose-700 border-rose-100', 'bg-rose-500', 'Ditolak'],
                                ];
                                $cfg = $statusConfig[$l['status_terakhir']] ?? $statusConfig['applied'];
                            @endphp
                            <div class="flex flex-col gap-1.5">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border shadow-sm {{ $cfg[0] }} w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $cfg[1] }}"></span>
                                    {{ $cfg[2] }}
                                </span>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('applicants.edit', $l['lamaran_id']) }}" class="p-2.5 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-all duration-200" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <button class="p-2.5 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all duration-200" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-16 text-center text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Belum ada pelamar yang masuk
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @include('company.components.table-pagination', [
            'id' => 'applicants',
            'totalRows' => count($lamaran),
            'rowsPerPage' => 50,
            'currentPage' => 1,
        ])
    </div>
</div>
@endsection